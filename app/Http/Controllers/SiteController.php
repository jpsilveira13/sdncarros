<?php

namespace App\Http\Controllers;

use App\Models\Cotacao;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Ano;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;


class SiteController extends Controller
{

    private $cotacao;
    public function __construct(Cotacao $cotacao)
    {
        $this->cotacao = $cotacao;
    }

    public function cotacao()
    {

        Session::put('marca',Input::get('marca'));
        Session::put('modelo',Input::get('modelo'));
        Session::put('valor',Input::get('valor'));
        Session::put('ano',Input::get('ano'));


        return view('site.resultado');
    }

    public function salvarCotacao(){
        $inputData = Input::get('formData');


        parse_str($inputData, $formFields);
        $userData = array(
            'marca'                             =>  $formFields['marca'],
            'modelo'                            =>  $formFields['modelo'],
            'valor'                             =>  $formFields['valor'],
            'ano'                               =>  $formFields['ano'],
            'valor_min'                         =>  $formFields['valor_min'],
            'valor_max'                         =>  $formFields['valor_max'],
            'km'                                =>  $formFields['km'],
            'nome'                              =>  $formFields['nome'],
            'email'                             =>  $formFields['email'],
            'tel'                               =>  $formFields['tel'],


        );
        $userData['valor'] = str_replace(".","",$userData['valor']);
        $userData['valor'] = str_replace(",",".",$userData['valor']);
        $userData['valor'] = str_replace("R$ ","",$userData['valor']);
        $valorNovo = floatval($userData['valor']) ;
        if($userData['km'] == 20000){
            $userData['valor_min'] = $valorNovo * 0.70;
            $userData['valor_max'] = $valorNovo * 0.90;
        }elseif ($userData['km'] == 40000){
            $userData['valor_min'] = $valorNovo * 0.69;
            $userData['valor_max'] = $valorNovo * 0.89;
        }elseif ($userData['km'] == 60000){
            $userData['valor_min'] = $valorNovo * 0.68;
            $userData['valor_max'] = $valorNovo * 0.88;
        }elseif ($userData['km'] == 80000){
            $userData['valor_min'] = $valorNovo * 0.67;
            $userData['valor_max'] = $valorNovo * 0.87;
        }elseif ($userData['km'] == 100000){
            $userData['valor_min'] = $valorNovo * 0.66;
            $userData['valor_max'] = $valorNovo * 0.86;
        }elseif ($userData['km'] == 120000){
            $userData['valor_min'] = $valorNovo * 0.64;
            $userData['valor_max'] = $valorNovo * 0.84;
        }else{
            $userData['valor_min'] = $valorNovo * 0.62;
            $userData['valor_max'] = $valorNovo * 0.82;
        }
        $userData['valor_min'] = number_format(round($userData['valor_min'], -2), 2, '.', '');
        $userData['valor_max'] = number_format(round($userData['valor_max'], -2), 2, '.', '');

        $rules = array(
            'nome'                    =>  'required',
            'email'                   =>  'required',
        );


        $validator = Validator::make($userData,$rules);
        if($validator->fails()){
            return Response::json(array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }else {

            $cotacao = Cotacao::create($userData);
            if($cotacao) {

                //return success  message
                return Response::json(array(
                    'success' => true,
                    'userData' => $userData,
                    'id' => $cotacao->id
                ));
            }

        }
    }

    public function salvarAgendamento(){
        $inputData = Input::get('formData');


        parse_str($inputData, $formFields);
        $userData = array(
            'id'                                =>  $formFields['id'],
            'local'                             =>  $formFields['local'],
            'data'                              =>  $formFields['data'],
            'periodo'                           =>  $formFields['periodo'],


        );

        $rules = array(
            'local'                     =>  'required',
            'data'                      =>  'required',
        );


        $validator = Validator::make($userData,$rules);
        if($validator->fails()){
            return Response::json(array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }else {
            $mail = \Mail::send('emails.contactCotacao',$userData,function($message) use ($userData){
                $message->from('naoresponder@sdncar.com.br', 'Sdn Car | Vendas em 24h');

                $message->to('contato@sdncar.com.br');
                $message->subject('Sdn Car, enviou uma mensagem para você ');
            });
            $cotacao = Cotacao::find($userData['id']);
            $cotacao->local = $userData['local'];
            $cotacao->data = $userData['data'];
            $cotacao->periodo = $userData['periodo'];
            if($cotacao->save()) {

                //return success  message
                return Response::json(array(
                    'success' => true,
                    'userData' => $userData,
                ));
            }

        }
    }

    public function listarVeiculos(){
        $veiculos = $this->cotacao->orderBy('status','asc')->orderBy('id','desc')->paginate(50);
        return view('site/lista',compact('veiculos'));
    }

    public function visto(){
        $id = Input::get('id');
        $visto = $this->cotacao->find($id);
        if($visto->status == "nv")
        {
            $visto->status = "v";
            $visto->save();
        }else{
            return false;
        }
    }
    public function contatoHome(){

        $inputData = Input::get('formData');


        parse_str($inputData, $formFields);
        $userData = array(
            'nome'                              =>  $formFields['nome'],
            'email'                             =>  $formFields['email'],
            'telefone'                          =>  $formFields['telefone'],
            'mensagem'                          =>  $formFields['mensagem'],

        );

        $rules = array(
            'nome'                       =>  'required',
            'email'                      =>  'required',
        );


        $validator = Validator::make($userData,$rules);
        if($validator->fails()){
            return Response::json(array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            ));
        }else {
            $mail = \Mail::send('emails.contactHome',$userData,function($message) use ($userData){
                $message->from('naoresponder@sdncar.com.br', 'Sdn Car | Vendas em 24h');

                $message->to('contato@sdncar.com.br');
                $message->subject('Sdn Car, enviou uma mensagem para você ');
            });

            //return success  message
            return Response::json(array(
                'success' => true,
            ));

        }
    }

    public function sendEmailTest(){
        \Mail::send('emails.teste', ['msg' => 'hello'], function ($message) {
            $message->from('suporte@sempredanegocio.com.br', 'João Paulo');

            $message->to('samotinho@gmail.com', 'Pedro 2')->subject('My Test Email!');
        });

        var_dump('sent');
    }

    public function getMarca(){
        $marcas = Marca::orderBy('marca','asc')->get();

        return view('site.principal',compact('marcas'));
    }

    public function getModelo(){
        $marca_id = Input::get('marca_id');
        $modelo = Modelo::where('codigo_marca','=',$marca_id)->orderBy('modelo','asc')->get();
        return Response::json($modelo);
    }
    public function getAno(){
        $modelo_id = Input::get('modelo_id');
        $query = Ano::where('codigo_modelo','=',$modelo_id)->orderBy('ano','asc')->get();
        return Response::json($query);
    }

}