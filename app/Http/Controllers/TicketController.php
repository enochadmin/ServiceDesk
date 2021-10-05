<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Mail;
use App\Models\Client;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request){
        $request->validate([
            'Issue' => 'required',
            'Description' => 'required',
            'document' => 'required', //|mimes:doc,docx,pdf,txt,csv|max:2048',
            'project_id' => 'required',
            'Tag_id' => 'required',
            'Priorty' => 'required',
            'Date' => 'required',
            'ticket_status' => 'required',
        ]);
        Ticket::create($request->all());

       // check if client exist
        $client = Client::where('id',$request->client_id)->first();
        // if client exist create ticket and send email to the client
        if($client){
            Ticket::create($request->all());

            // get clients representative first name, last name and email address
            $ripFName = $client->Representative_FirstName;
            $ripLName = $client->Representative_LastName;
            $ripEmail = $client->Representative_UserName;
            Mail::to($ripEmail)->send(new \App\Mail\MyTestMail($ripFName,$ripLName));
        }else{
            return response()->json(['errors' => 'Client not found']);
        }
        if($validator->fails()) {

            return response()->json(['error'=>$validator->errors()], 401);
         }


        // if ($document = $request->file('document')) {
        //     $path = $document->store('public/files');
        //     $name = $document->getClientOriginalName();

        //     //store your file into directory and db
        //     $save = new File();
        //     $save->name = $document;
        //     $save->store_path= $path;
        //     $save->save();

        //     return response()->json([
        //         "success" => true,
        //         "message" => "File successfully uploaded",
        //         "document" => $document
        //     ]);

        // }

    }


    public function show(Ticket $ticket)    {
        return Ticket::find($id);
        $ticket = Ticket::findOrFail($id)->get();
    }

    public function edit(Ticket $ticket){
        //
    }

    public function update(Request $request, $id){
        $ticket = Ticket::find($id);
        $ticket->update($request->all());
        return $ticket;
    }

    public function destroy($id){
        return Ticket::destroy($id);
    }
    // search project
    public function searchTicket($name){
        return Ticket::where('name','like','%'.$name.'%')->get();
    }


}
