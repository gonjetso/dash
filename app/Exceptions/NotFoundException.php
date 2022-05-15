<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct( $message = null ) 
    {
        $this->message  =   $message ?: __('The resource of the page you tried to access is not available or might have been deleted.' );
    }

    public function render( $request )
    {        
        if ( ! $request->expectsJson() ) {
            return response()->view( 'pages.errors.not-allowed', [
                'title'         =>  __( 'Not Found Exception' ),
                'message'       =>  $this->getMessage(),
            ]);
        }

        return response()->json([ 
            'status'  =>  'failed',
            'message' => $this->getMessage(),
        ], 401);
    }
}
