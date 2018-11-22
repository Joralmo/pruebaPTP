<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PseTransactionResponse extends Model
{
    protected $table = "pse_transaction_responses";
    protected $fillable = ['transactionID', 'sessionID', 'returnCode', 'trazabilityCode', 'transactionCycle', 'bankCurrency', 'bankFactor', 'bankURL', 'responseCode', 'responseReasonCode', 'responseReasonText'];
}
