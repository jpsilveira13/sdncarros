<?php

namespace App\Http\Controllers;

use App\Models\Cotacao;
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
            $userData['valor_min'] = $valorNovo * 0.64;
            $userData['valor_max'] = $valorNovo * 0.84;
        }elseif ($userData['km'] == 40000){
            $userData['valor_min'] = $valorNovo * 0.63;
            $userData['valor_max'] = $valorNovo * 0.79;
        }elseif ($userData['km'] == 60000){
            $userData['valor_min'] = $valorNovo * 0.62;
            $userData['valor_max'] = $valorNovo * 0.78;
        }elseif ($userData['km'] == 80000){
            $userData['valor_min'] = $valorNovo * 0.61;
            $userData['valor_max'] = $valorNovo * 0.77;
        }elseif ($userData['km'] == 100000){
            $userData['valor_min'] = $valorNovo * 0.60;
            $userData['valor_max'] = $valorNovo * 0.76;
        }elseif ($userData['km'] == 120000){
            $userData['valor_min'] = $valorNovo * 0.58;
            $userData['valor_max'] = $valorNovo * 0.74;
        }else{
            $userData['valor_min'] = $valorNovo * 0.56;
            $userData['valor_max'] = $valorNovo * 0.72;
        }
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

                $message->to('samotinho@gmail.com');
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
        $veiculos = $this->cotacao->orderBy('id','desc')->paginate();
        return view('site/lista',compact('veiculos'));
    }

    public function sendEmailTest(){
        \Mail::send('emails.teste', ['msg' => 'hello'], function ($message) {
            $message->from('suporte@sempredanegocio.com.br', 'João Paulo');

            $message->to('samotinho@gmail.com', 'Pedro 2')->subject('My Test Email!');
        });

        var_dump('sent');
    }

}