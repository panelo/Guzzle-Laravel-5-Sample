<?php namespace App\Http\Controllers;

use Admin;
use AdminAuth;
use Illuminate\Http\Request;
use GuzzleHttp\Client; 
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;

class LeadsController extends Controller {
	
    public function getIndex() //Retrieve
    { 
		$client = new Client(); 
		$response = $client->get('http://api.example.com/v1/retrieve');
		$body = json_decode($response->getBody(), TRUE);
	    $content = view('retrieve')->with('body',$body);
		return View::make($content);
    }
	
	public function postForm(Request $request) //Create
	{
		$lastname = $request->get('lastname');
		$firstname = $request->get('firstname');
		$middlename = $request->get('middlename');
		try {
			$client = new Client(); 
			$request = $client->createRequest('POST', 'http://api.example.com/v1/retrieve', [
			    'body' => [
			        'firstname' => $firstname,
			        'middlename' => $middlename,
			        'lastname' => $lastname
			    ]
			]);
			$response = $client->send($request);
		} catch (RequestException $e) {
		    dd($e->getRequest());
		}
		return redirect()->route('create');
	}
	
	public function postForm(Request $request) //Update
	{
		$id = $request->get('id');
		$lastname = $request->get('lastname');
		$firstname = $request->get('firstname');
		$middlename = $request->get('middlename');
		try {
			$client = new Client(); 
			$request = $client->createRequest('POST', 'http://api.example.com/v1/retrieve/$id', [
			    'body' => [
			        'firstname' => $firstname,
			        'middlename' => $middlename,
			        'lastname' => $lastname
			    ]
			]);
			$response = $client->send($request);
		} catch (RequestException $e) {
		    dd($e->getRequest());
		}
		return redirect()->route('update');
	}
}