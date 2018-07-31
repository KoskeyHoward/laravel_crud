<?php

namespace App\Http\Controllers;
use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //

public function create()
{
   return view('user.create');
}

public function index()
    {
        $tickets = Ticket::where('user_id', auth()->user()->id)->get();
        
        return view('user.index',compact('tickets'));
    }

public function store(Request $request)
    {
        $ticket = new Ticket();
        $data = $this->validate($request, [
            'description'=>'required',
            'title'=> 'required'
        ]);
       
        $ticket->saveTicket($data);
      
        return redirect('/home')->with('success', 'New support ticket has been created! Wait sometime to get resolved');
    }
public function edit($id)
    {
        $ticket = Ticket::where('user_id', auth()->user()->id)
                        ->where('id', $id)
                        ->first();

        return view('user.edit', compact('ticket', 'id'));
    }
   
 public function update(Request $request, $id)
    {
        $ticket = new Ticket();
        $data = $this->validate($request, [
            'description'=>'required',
            'title'=> 'required'
        ]);
        $data['id'] = $id;
        $ticket->updateTicket($data);

        return redirect('/home')->with('success', 'New support ticket has been updated!!');
    }



}
