<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    /**
     * Determina se l'utente è autorizzato a effettuare questa richiesta.
     */
    public function authorize(): bool
    {
        return true; // Cambia se necessario
    }

    /**
     * Regole di validazione per il form.
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'operator_id' => 'required|exists:operators,id',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:Assegnato,In lavorazione,Chiuso',
        ];
    }

    /**
     * Messaggi di errore personalizzati.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.string' => 'Il titolo deve essere una stringa.',
            'title.max' => 'Il titolo non può superare i 255 caratteri.',
            'description.required' => 'La descrizione è obbligatoria.',
            'description.string' => 'La descrizione deve essere una stringa.',
            'operator_id.required' => 'Devi selezionare un operatore.',
            'operator_id.exists' => 'L\'operatore selezionato non è valido.',
            'category_id.required' => 'Devi selezionare una categoria.',
            'category_id.exists' => 'La categoria selezionata non è valida.',
            'status.required' => 'Devi selezionare uno stato.',
            'status.in' => 'Lo stato selezionato non è valido.',
        ];
    }
}
