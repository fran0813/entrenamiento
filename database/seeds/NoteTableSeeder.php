<?php

use Illuminate\Database\Seeder;
use App\Note;

class NoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $note_high = new Note();
	    $note_high->name = 'Alto';
	    $note_high->save();

	    $note_medium = new Note();
	    $note_medium->name = 'Medio';
	    $note_medium->save();

	    $note_low = new Note();
	    $note_low->name = 'Bajo';
	    $note_low->save();
    }
}
