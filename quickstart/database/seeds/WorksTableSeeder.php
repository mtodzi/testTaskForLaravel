<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class WorksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = Storage::disk('local');
        //$contents = $f->allFiles();
        //Фамилии
        $str_surname = $f->get('public/txt/surnames.txt');
        $array_surname = str_getcsv($str_surname, ";");
        $count_array_surname = count($array_surname);
        //Имена
        $str_name = $f->get('public/txt/name.txt');
        $array_name = str_getcsv($str_name, ";");
        $count_array_name = count($array_name);
        //Отчество
        $str_patronymic = $f->get('public/txt/patronymic.txt');
        $array_patronymic = str_getcsv($str_patronymic, ";");
        $count_array_patronymic = count($array_patronymic);
        $i = 1;
        $this->InsertTeble(trim($array_surname[rand(0, $count_array_surname-1)]),
                trim($array_name[rand(0, $count_array_name-1)]),
                trim($array_patronymic[rand(0,  $count_array_patronymic-1)]),
                date('Y-m-d'), 1, NULL, rand(1000,1500));
        $i++;
        $array_id = array();
        for($j=1;$j<=5;$j++){
            $array_id[$j] = $i; 
            $this->InsertTeble(trim($array_surname[rand(0, $count_array_surname-1)]),
                trim($array_name[rand(0, $count_array_name-1)]),
                trim($array_patronymic[rand(0,  $count_array_patronymic-1)]),
                date('Y-m-d'), 2, 1, rand(1000,1300));
            $i++;
        }
        
        $array_id_a = array();
        $y = 0;
        foreach ($array_id as $id){
            for($j=1;$j<=5;$j++){
                $array_id_a[$y] = $i; 
                $this->InsertTeble(trim($array_surname[rand(0, $count_array_surname-1)]),
                    trim($array_name[rand(0, $count_array_name-1)]),
                    trim($array_patronymic[rand(0,  $count_array_patronymic-1)]),
                    date('Y-m-d'), 3, $id, rand(1000,1200));
                $i++;
                $y++;
            }
        }
        
        $array_id = array();
        $y = 0;
        foreach ($array_id_a as $id){
            for($j=1;$j<=5;$j++){
                $array_id[$y] = $i; 
                $this->InsertTeble(trim($array_surname[rand(0, $count_array_surname-1)]),
                    trim($array_name[rand(0, $count_array_name-1)]),
                    trim($array_patronymic[rand(0,  $count_array_patronymic-1)]),
                    date('Y-m-d'), 4, $id, rand(1000,1100));
                $i++;
                $y++;
            }
        }
        
        $array_id_a = array();
        $y = 0;
        foreach ($array_id as $id){
            for($j=1;$j<=4;$j++){
                $array_id_a[$y] = $i; 
                $this->InsertTeble(trim($array_surname[rand(0, $count_array_surname-1)]),
                    trim($array_name[rand(0, $count_array_name-1)]),
                    trim($array_patronymic[rand(0,  $count_array_patronymic-1)]),
                    date('Y-m-d'), 5, $id, rand(950,1000));
                $i++;
                $y++;
            }
        }
        
        $array_id = array();
        $y = 0;
        foreach ($array_id_a as $id){
            for($j=1;$j<=100;$j++){
                $array_id[$y] = $i; 
                $this->InsertTeble(trim($array_surname[rand(0, $count_array_surname-1)]),
                    trim($array_name[rand(0, $count_array_name-1)]),
                    trim($array_patronymic[rand(0,  $count_array_patronymic-1)]),
                    date('Y-m-d'), 6, $id, rand(500,900));
                $i++;
                $y++;
            }
        }
        
    }
  
    
    
    
    public function InsertTeble($surname,$name,$patronymic,$date_receipt,$id_position,$chief,$salary){
        DB::table('workers')->insert([
            'surname' => $surname,
            'name' => $name ,
            'patronymic' => $patronymic,
            'date_receipt' => $date_receipt,
            'id_position' =>$id_position,
            'id_worker'=>$chief,
            'salary'=>$salary,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);   
    }
}
