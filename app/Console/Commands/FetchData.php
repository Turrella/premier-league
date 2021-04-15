<?php

namespace App\Console\Commands;

use App\Models\Element\Element;
use App\Models\Element\ElementStat;
use App\Models\Element\ElementType;
use App\Models\Team\Team;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Schema;

class FetchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:data {importer=http}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch all the data';
    protected $tables;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->tables = ['teams', 'element_types', 'element_stats', 'elements'];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $importer = $this->argument('importer');
        switch ($importer) {
            case 'http':
                $url = config('premierLeague.data_url');

                $this->info('fetch url: ' . $url);
                $response = Http::get($url);

                if ($response->failed()) {
                    $this->error('fetch data failed, please check your network and env file');
                    Log::error('fetch data failed at ' . time());
                    exit();
                }
                $data = $response->json();
                break;

            default:
                $data = array();
                break;
        }

        foreach ($this->tables as $table) {
            if (!key_exists($table, $data)) {
                $this->error('api return data has changed, ' . $table . ' has been removed');
                Log::error('fetch data failed at ' . time());
                exit();
            } else {
                $details = $data[$table];
                foreach ($details as $detail) {
                    try {
                        switch ($table) {
                            case 'teams':
                                $column = Schema::getColumnListing('teams');
                                Team::updateData($column, $detail);
                                break;
                            case 'elements':
                                $column = Schema::getColumnListing('elements');
                                Element::updateData($column, $detail);
                                break;
                            case 'element_types':
                                $column = Schema::getColumnListing('element_types');
                                ElementType::updateData($column, $detail);
                                break;
                            case 'element_stats':
                                $column = Schema::getColumnListing('element_stats');
                                ElementStat::updateData($column, $detail, 'name');
                                break;
                            default:
                                $this->info('default');
                                break;
                        }
                    } catch (Exception $exception) {
                        $this->error('update data error: ' . $exception->getMessage());
                        continue;
                    }
                }
            }
        }
        return 0;
    }
}
