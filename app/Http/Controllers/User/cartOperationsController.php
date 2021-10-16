<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use PhpParser\Node\Expr\Throw_;
use Throwable;

class cartOperationsController extends Controller
{
    //

    public function deleteCartFromDatabase($table, $identifier)
    {
        # code...
        DB::table($table)->where('identifier', '=', $identifier)->delete();
    }

    public function addCartInDatabase($table, $identifier, $content)
    {
        # code...
        DB::table($table)->upsert([
            'identifier' => $identifier,
            'instance'   => 'default',
            'content'    => serialize($content),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ], ['identifier', 'instance'], ['content']);
    }

    public function updateCartInDatabase($table, $identifier, $content)
    {
        # code...
        try {
            // $this->deleteCartFromDatabase($table, $identifier);
            $this->addCartInDatabase($table, $identifier, $content);
            return;
        } catch (Throwable $e) {
            return abort(500);
        }
    }

    public function getCartFromDatabase($table, $identifier)
    {
        # code...
        try {
            $serializedContent = DB::table($table)->where('identifier', '=', $identifier)->latest()->first();
            $content = unserialize(data_get($serializedContent, 'content'));
            return $content;
        } catch (Throwable $e) {
            return abort(500);
        }
    }
}
