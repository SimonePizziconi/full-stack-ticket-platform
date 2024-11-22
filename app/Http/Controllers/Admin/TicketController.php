<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Models\Category;
use App\Models\Operator;
use App\Models\Ticket;
use Illuminate\Http\Request;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Recupera i filtri dalla richiesta
        $status = $request->input('status');
        $category = $request->input('category');

        // Costruisce la query
        $query = Ticket::query();

        if ($status) {
            $query->where('status', $status);
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        // Esegue la query con paginazione
        $tickets = $query->orderBy('created_at', 'desc')->paginate(10);

        // Passa anche le categorie disponibili per il filtro
        $categories = Category::orderBy('name')->get();

        return view('admin.tickets.index', compact('tickets', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $operators = Operator::orderBy('name')->get();
        return view('admin.tickets.create', compact('categories', 'operators'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        $data = $request->all();

        $new_ticket = Ticket::create($data);

        return redirect()->route('admin.ticket.index', $new_ticket)->with('success', '"' . $data['title'] .  '" è stato aggiunto correttamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        $categories = Category::orderBy('name')->get();
        $operators = Operator::orderBy('name')->get();
        return view('admin.tickets.edit', compact('categories', 'operators', 'ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        $data = $request->all();

        $ticket->update($data);

        return redirect()->route('admin.ticket.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
