<?php

namespace Task\CollectionParser\Commands;

use Illuminate\Console\Command;

class ModelPublish extends Command
{
    // Our Stub for the Model. 
    const STUBS = '/task/collection-parser/resources/stubs/';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'model:publish {--collectionData=NULL}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creation of models (entities) dynamically based on some csv files provided by the customers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * 
     * @return int
     */

    public function handle()
    {
        
        $data = $this->option('collectionData');
        
        //Checking the artisan if called from Browser or from CLI.
        // If CLI, we will not parse any CSV from a pulic upload file
        // In any case we will try to build a dataCollection array to parse

        if ($data !='NULL'){
            $dataCollection = json_decode(urldecode($data),TRUE); // Only encoded parameter is accepted and expected.
        }
        else {
            $csv = public_path('uploads/dataCollection.csv');
            $dataCollection = [];
            if (($handle = fopen($csv, 'r')) !== FALSE) { // Check if the resource/csv is valid!
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { // Check if opening the file is OK!
                    $name = '';
                    $scopes = [];
                    foreach ($data as $index=>$entity){
                        if($index == 0){
                            $name = $entity;
                        }else{
                            $scopes[] =  $entity;
                        }
                    }
                    $dataCollection[] = [
                        'scope' => $scopes,
                        'name' => $name,
                    ];
                }
                fclose($handle);
            }
        }
        //Processing the data
        foreach($dataCollection as $item){
            $template = str_replace(
                [
                    '{{namespace}}',
                    '{{class_name}}',
                    '{{table_name}}'
                ],
                [
                    $this->convertModelNameSpace($item['scope']), // App\Models\IndirectEmissionsOwned\Electricity
                    $this->convertClassName($item['name']), // MeetingRooms
                    $item['name']//meeting-rooms
                ],
                $this->getStub('Model')
            );
            $path = app_path($this->convertModelPath($item['scope']));

            if(!file_exists($path)){
                mkdir($path, 0755, true);
            }
            file_put_contents(app_path("{$this->convertModelPath($item['scope'])}/{$this->convertClassName($item['name'])}.php"), $template);
            $this->info("\n{$this->convertClassName($item['name'])}.php Model Created successfully");
        }


    }
    /**
     * Generate the NameSpace
     * 
     * @return str
     */
    private function convertModelNameSpace($input){
        $namespace = 'App/Models';
        foreach($input as $namespaceItem){
            $path = $this->modelNamespaceScopeBeautify($namespaceItem);
            $namespace .= '/'.$path;
        }

        return $namespace;
    }
    
    /**
     * Generate the Paths of the files
     * 
     * @return str
     */
    private function convertModelPath($input){
        $modelPath = 'Models';
        foreach($input as $namespaceItem){
            $path = $this->modelNamespaceScopeBeautify($namespaceItem);
            $modelPath .= '/'.$path;
        }

        return $modelPath;
    }
    
    /**
     * Beautification of the Namespeaces
     * 
     * @return str
     */
    private function modelNamespaceScopeBeautify($input){
        return implode("",array_map('ucwords', preg_split('/–|-/', $input)));
    }

    /**
     * ClassName Conversion
     * 
     * @return str
     */
    private function convertClassName($input){
        return implode("",array_map('ucwords', preg_split('/–|-/', $input)));
    }

    /**
     * Get the StubPath 
     * 
     * @return void
     */
    private static function getStubPath(){
        return self::STUBS;
    }
    
    /**
     * Feeding Model in the Stub
     * 
     * @return void
     */
    private static function getStub($type){
        return file_get_contents(base_path('vendor') . self::getStubPath().$type.'.stub');
    }
}
