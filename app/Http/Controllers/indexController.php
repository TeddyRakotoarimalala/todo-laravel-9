<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Route;

class indexController extends Controller
{
	public function index (Request $request)
	{
		
		$todos = Todo::orderBy('created_at', 'asc')->get();
		$remaining = Todo::where('completed', 0)->count();
		$clear = Todo::where('completed', 1)->count();
		$total = Todo::all()->count();
		return view('index', [
			'todos'	=>	$todos,
			'remaining' => $remaining,
			'clear'	=> $clear > 0 ? true : false,
			'total'			=>	$total
		]);

	}

	public function remainingTodo (Request $request)
	{

		$todos = Todo::where('completed', 0)->orderBy('created_at', 'asc')->get();
		$remaining = Todo::where('completed', 0)->count();
		$clear = Todo::where('completed', 1)->count();
		$total = Todo::all()->count();
		return view('index', [
			'todos'	=>	$todos,
			'remaining' => $remaining,
			'clear'	=> $clear > 0 ? true : false,
			'total'			=>	$total
		]);

	}

	public function completedTodo (Request $request)
	{

		$todos = Todo::where('completed', 1)->orderBy('created_at', 'asc')->get();
		$remaining = Todo::where('completed', 0)->count();
		$clear = Todo::where('completed', 1)->count();
		$total = Todo::all()->count();
		return view('index', [
			'todos'			=>	$todos,
			'remaining' =>	$remaining,
			'clear'			=>	$clear > 0 ? true : false,
			'total'			=>	$total
		]);

	}

	public function add(Request $request)
	{

		$validated = $request->validate([
			'title' => ['required', 'max:255', 'min:3']
		]);

		if( !Todo::create($validated) ){
			return to_route('index')->with('danger', 'Il y a un probleme, veillez reessayer plus tard.');
		}

		return to_route('index')->with('success', 'Tache ajouter avec succes.');

	}

	public function complete(Request $request, Todo $todo)
	{

		if (!$todo->update(['completed' => 1])) {
			return to_route('index')->with('danger', 'Il y a un probleme, veillez reessayer plus tard.');
		}

		return to_route('index')->with('success', 'Tache terminer.');

	}

	public function remove (Request $request, Todo $todo)
	{

		if( !$todo->delete()) {
			return to_route('index')->with('danger', 'Il y a un probleme, veillez reessayer plus tard.');
		}

		return to_route('index')->with('success', 'Tache supprimer avec succes.');

	}

	public function clearCompleted (Request $request)
	{

		if( !Todo::where('completed', 1)->delete() ) {
			return to_route('index')->with('danger', 'Il y a un probleme, aucune tache terminee');
		}

		return to_route('index')->with('success', 'Taches terminees supprimer avec succes');
	}

}
