<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\BulkCallJob;
use App\Jobs\WhatsappApi;
use App\Mail\DocSignedMail;
use App\Models\Call;
use App\Models\Customer;
use App\Models\CustomerNudgeLog;
use App\Models\Nudge;
use App\Models\NudgeCallLog;
use App\Models\Pdf;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        return view('backend.add_new_doc');
    }
}
