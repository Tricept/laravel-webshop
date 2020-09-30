<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FaqTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_can_create_faqs()
    {
        $question = new Question();
        $question->title = 'Eine Frage';
        $question->save();

        $question->answer()->create([
            'content' => 'Das ist die Antwort',
        ]);

        $this->assertEquals(1, Question::count());
        $this->assertEquals(1, Answer::count());
    }

    /** @test **/
    public function it_can_create_a_answer()
    {
        $question = Question::factory()->create();

        $answer = new Answer();
        $answer->content = 'Ein Inhalt';
        $answer->question()->associate($question);
        $answer->save();

        $this->assertEquals(1, Answer::count());
    }
}
