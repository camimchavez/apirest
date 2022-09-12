<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ArticulosModel;

class Articulos extends Controller
{


    /*===================================================
     Mostrar todos los registros
     ==================================================*/
     public function index(){
        $request = \Config\Services::request();


        $headers = $request->headers();

        if(array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])){

           if($request->hasHeader('Authorization') == "Authorization: 123abcd"){
                $db = new ArticulosModel();

                $results = $db->findAll();

                if(!empty($results)){

                    $json = array(
                    "status"=>200,
                    "total_results"=>count($results),
                    "message"=>$results
                    );
                }else{
                    $json = array(
                    "status"=>400,
                    "total_results"=>0,
                    "message"=>"Ningún registro cargado");
                }
            }else{
                $json = array(
                   "status"=>500,
                   "total_results"=>0,
                   "message"=>"El token es inválido");
             }
          }else{
             $json = array(
                "status"=>500,
                "total_results"=>0,
                "message"=>"No tiene permisos para visualizar los registros");
          }


        echo json_encode($json, true);
     }

         /*===================================================
     Mostrar un registro
     ==================================================*/
     public function show($id){
        $request = \Config\Services::request();


        $headers = $request->headers();

        if(array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])){

            if($request->hasHeader('Authorization') == "Authorization: 123abcd"){
        

                $db = new ArticulosModel();

                $row = $db->find($id);

                if(!empty($row)){

                    $json = array(
                    "status"=>200,
                    "total_row"=>1,
                    "message"=>$row
                    );
                }else{
                    $json = array(
                    "status"=>404,
                    "total_row"=>0,
                    "message"=>"Ningún registro cargado");
                }
            }else{
                $json = array(
                "status"=>500,
                "total_results"=>0,
                "message"=>"El token es inválido");
            }
        }else{
            $json = array(
                "status"=>500,
                "total_results"=>0,
                "message"=>"No tiene permisos para visualizar los registros");
        }
        echo json_encode($json, true);
    }
}   