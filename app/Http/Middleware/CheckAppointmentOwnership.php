<?php

namespace App\Http\Middleware;

use App\Models\Appointment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAppointmentOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the appointment ID from the route
        $appointmentId = $request->route('id');

        // Check if the appointment belongs to the user
        $appointment = Appointment::find($appointmentId);
        if (!$appointment || $appointment->patient_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized access'], 403);
        }

        return $next($request);
    }
}