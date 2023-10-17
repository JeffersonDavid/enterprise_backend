<?php
namespace App\Sources;

use Illuminate\Database\Eloquent\Model;

use App\Contracts\TransactionContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Queue;
use Illuminate\Http\Request;
use App\Observers\TransactionOberver;
use App\Jobs\CreateTransactionJob;
use Illuminate\Foundation\Bus\PendingDispatch;

class FromSource
{
    private Request $request;
    private PendingDispatch $transaction;
    private Model $Modelsource;

    private string $source;
    private string $mode = '';
    private array $validatedData = [];
    private array $transaction_data;
    private array $params = [];

    private const ALLOWED_TYPES = ['JSON','FORM'];



    public function __construct(Request $request) { 
        $this->request = $request; 
    }

    public static function create(Request $request)
    {
        return new self($request);
    }

    public function validated( string $requestType = null )
    {
        if (!in_array($requestType, self::ALLOWED_TYPES)) {
            throw new \Exception('Request has invalid format');
        }

        if ($requestType === 'JSON') {
           $this->params = $this->request->json()->all();
        } elseif ($requestType === 'FORM') {
            $this->params = $this->request->all();
        }

        return $this;
    }

   
    public function mode( string $mode)
    {
        $this->mode = $mode;
        return $this;
    }


    public function start()
    {
        $this->applyMode();
        return $this;
    }


    private function applyMode()
    {

        $transaction_data = [
            'transaction_params'=> (string) json_encode($this->params),
            'transaction_headers' => (string) json_encode($this->request->headers->all()),
            'transaction_source' => (string) $this->request->header('Referer') ? $this->request->header('Referer') : 'unknown',
            'transaction_source_ip'=> (string) $this->request->ip(),
            'transaction_type'=> (int) $this->params['transaction_type'],
        ];

        $this->transaction_data = $transaction_data;
 

        if ($this->mode === 'queue') {
            $x = CreateTransactionJob::dispatch( $this->transaction_data );
        }
       
        return $this;
    }
}
