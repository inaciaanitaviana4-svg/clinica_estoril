<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function mostrar_dashboard_medico(){
        return view("dashboard.medico", );
    }
    public function mostrar_dashboard_recepcionista(){
        return view("dashboard.recepcionista", );
    }
    public function mostrar_dashboard_paciente(){
        return view("dashboard.paciente", );
        
    }
}