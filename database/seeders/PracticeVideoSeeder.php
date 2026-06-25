<?php

namespace Database\Seeders;

use App\Models\PracticeVideo;
use Illuminate\Database\Seeder;

class PracticeVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = [
            [
                'title' => "How to Tie Your Shoes (Terry Moore)",
                'youtube_id' => 'zAFcV7zuUDA',
                'category' => 'Life Skills',
                'difficulty' => 'Easy',
                'duration' => '3:00',
                'description' => 'Simak presentasi singkat dari Terry Moore tentang cara mengikat tali sepatu yang benar dan efisien, pelajaran kecil yang membawa perubahan besar.',
                'transcript_data' => [
                    [
                        'id' => 1,
                        'start' => 12.0,
                        'end' => 23.5,
                        'text' => "I'm used to thinking of the TED audience as a wonderful collection of some of the most effective, intelligent, intellectual, um, savvy, worldly and innovative people in the world.",
                        'blanks' => [
                            ['word_index' => 3, 'hint' => 't'],
                            ['word_index' => 8, 'hint' => 'c']
                        ]
                    ],
                    [
                        'id' => 2,
                        'start' => 24.0,
                        'end' => 25.5,
                        'text' => "And I think that's true.",
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 't']
                        ]
                    ],
                    [
                        'id' => 3,
                        'start' => 26.0,
                        'end' => 34.0,
                        'text' => "However, I also have reason to believe that many, if not most, of you are actually tying your shoes incorrectly.",
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 'r'],
                            ['word_index' => 16, 'hint' => 'i']
                        ]
                    ],
                    [
                        'id' => 4,
                        'start' => 34.5,
                        'end' => 37.5,
                        'text' => "Now, I know that seems ludicrous.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 'l']
                        ]
                    ],
                    [
                        'id' => 5,
                        'start' => 37.5,
                        'end' => 43.5,
                        'text' => "And believe me, I lived the same sad life until about three years ago.",
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 'l'],
                            ['word_index' => 10, 'hint' => 'y']
                        ]
                    ],
                    [
                        'id' => 6,
                        'start' => 43.5,
                        'end' => 50.0,
                        'text' => "And what happened to me was I bought, what was for me, a very expensive pair of shoes.",
                        'blanks' => [
                            ['word_index' => 11, 'hint' => 'e'],
                            ['word_index' => 14, 'hint' => 's']
                        ]
                    ],
                    [
                        'id' => 7,
                        'start' => 50.0,
                        'end' => 55.0,
                        'text' => "But those shoes came with round nylon laces, and I couldn't keep them tied.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 'n'],
                            ['word_index' => 6, 'hint' => 'l']
                        ]
                    ],
                    [
                        'id' => 8,
                        'start' => 55.5,
                        'end' => 61.5,
                        'text' => "So I went back to the store and said to the owner, 'I love the shoes, but I hate the laces.'",
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 's'],
                            ['word_index' => 18, 'hint' => 'l']
                        ]
                    ],
                    [
                        'id' => 9,
                        'start' => 61.5,
                        'end' => 65.5,
                        'text' => "He took a look and said, 'Oh, you're tying them wrong.'",
                        'blanks' => [
                            ['word_index' => 7, 'hint' => 't'],
                            ['word_index' => 9, 'hint' => 'w']
                        ]
                    ],
                    [
                        'id' => 10,
                        'start' => 65.5,
                        'end' => 75.5,
                        'text' => "Now, up until that moment, I would have thought that, by age 50, one of the life skills that I had really nailed was tying my shoes.",
                        'blanks' => [
                            ['word_index' => 13, 'hint' => 's'],
                            ['word_index' => 17, 'hint' => 'n']
                        ]
                    ],
                    [
                        'id' => 11,
                        'start' => 75.5,
                        'end' => 79.5,
                        'text' => "But not so. Let me demonstrate.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 'd']
                        ]
                    ],
                    [
                        'id' => 12,
                        'start' => 79.5,
                        'end' => 83.5,
                        'text' => "This is the way that most of us were taught to tie our shoes.",
                        'blanks' => [
                            ['word_index' => 8, 'hint' => 't']
                        ]
                    ],
                    [
                        'id' => 13,
                        'start' => 84.0,
                        'end' => 87.0,
                        'text' => "Now, as it turns out—thank you.",
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 't']
                        ]
                    ],
                    [
                        'id' => 14,
                        'start' => 87.0,
                        'end' => 89.0,
                        'text' => "Wait, there's more.",
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'm']
                        ]
                    ],
                    [
                        'id' => 15,
                        'start' => 89.0,
                        'end' => 97.0,
                        'text' => "As it turns out, there's a strong form and a weak form of this knot, and we were taught to tie the weak form.",
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 's'],
                            ['word_index' => 10, 'hint' => 'w']
                        ]
                    ],
                    [
                        'id' => 16,
                        'start' => 97.5,
                        'end' => 99.5,
                        'text' => "And here's how to tell.",
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 't']
                        ]
                    ],
                    [
                        'id' => 17,
                        'start' => 100.0,
                        'end' => 108.5,
                        'text' => "If you pull the strands at the base of the knot, you can see that the bow will orient itself down the long axis of the shoe.",
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 's'],
                            ['word_index' => 15, 'hint' => 'o']
                        ]
                    ],
                    [
                        'id' => 18,
                        'start' => 108.5,
                        'end' => 112.0,
                        'text' => "That's the weak form of the knot.",
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'w']
                        ]
                    ],
                    [
                        'id' => 19,
                        'start' => 112.5,
                        'end' => 114.5,
                        'text' => "But not to worry.",
                        'blanks' => [
                            ['word_index' => 3, 'hint' => 'w']
                        ]
                    ],
                    [
                        'id' => 20,
                        'start' => 115.0,
                        'end' => 124.0,
                        'text' => "If we start over and simply go the other direction around the bow, we get this: the strong form of the knot.",
                        'blanks' => [
                            ['word_index' => 8, 'hint' => 'd'],
                            ['word_index' => 14, 'hint' => 's']
                        ]
                    ],
                    [
                        'id' => 21,
                        'start' => 124.5,
                        'end' => 134.0,
                        'text' => "And if you pull the cords under the knot, you will see that the bow orients itself along the transverse axis of the shoe.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 'c'],
                            ['word_index' => 15, 'hint' => 't']
                        ]
                    ],
                    [
                        'id' => 22,
                        'start' => 134.5,
                        'end' => 137.5,
                        'text' => "This is a stronger knot.",
                        'blanks' => [
                            ['word_index' => 3, 'hint' => 's']
                        ]
                    ],
                    [
                        'id' => 23,
                        'start' => 137.5,
                        'end' => 140.0,
                        'text' => "It will come untied less often.",
                        'blanks' => [
                            ['word_index' => 3, 'hint' => 'u']
                        ]
                    ],
                    [
                        'id' => 24,
                        'start' => 140.5,
                        'end' => 143.0,
                        'text' => "It will let you down less.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 'l']
                        ]
                    ],
                    [
                        'id' => 25,
                        'start' => 143.5,
                        'end' => 147.0,
                        'text' => "And not only that, it looks better.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 'l']
                        ]
                    ],
                    [
                        'id' => 26,
                        'start' => 147.5,
                        'end' => 150.5,
                        'text' => "We're going to do this one more time.",
                        'blanks' => [
                            ['word_index' => 7, 'hint' => 't']
                        ]
                    ],
                    [
                        'id' => 27,
                        'start' => 151.0,
                        'end' => 153.0,
                        'text' => "Start as usual.",
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'u']
                        ]
                    ],
                    [
                        'id' => 28,
                        'start' => 153.5,
                        'end' => 156.5,
                        'text' => "Go the other way around the loop.",
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 'l']
                        ]
                    ],
                    [
                        'id' => 29,
                        'start' => 157.0,
                        'end' => 159.0,
                        'text' => "Pull the knot.",
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'k']
                        ]
                    ],
                    [
                        'id' => 30,
                        'start' => 159.5,
                        'end' => 164.0,
                        'text' => "There it is: the strong form of the shoe knot.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 's']
                        ]
                    ],
                    [
                        'id' => 31,
                        'start' => 165.0,
                        'end' => 176.0,
                        'text' => "Now, in keeping with today's theme, I'd like to point out something you already know: that sometimes a small advantage someplace in life can yield tremendous results someplace else.",
                        'blanks' => [
                            ['word_index' => 13, 'hint' => 'a'],
                            ['word_index' => 18, 'hint' => 't']
                        ]
                    ],
                    [
                        'id' => 32,
                        'start' => 176.5,
                        'end' => 180.0,
                        'text' => "Live long and prosper.",
                        'blanks' => [
                            ['word_index' => 3, 'hint' => 'p']
                        ]
                    ]
                ]
            ],
            [
                'title' => 'Try Something New for 30 Days (Matt Cutts)',
                'youtube_id' => 'UNP03fDSj1U',
                'category' => 'TED Talk',
                'difficulty' => 'Medium',
                'duration' => '3:27',
                'description' => 'Simak presentasi singkat dari Matt Cutts tentang pentingnya mencoba hal baru selama 30 hari untuk membangun kebiasaan positif.',
                'transcript_data' => [
                    [
                        'id' => 1,
                        'start' => 12.0,
                        'end' => 22.0,
                        'text' => 'A few years ago, I felt like I was stuck in a rut, so I decided to follow in the footsteps of the great American philosopher, Morgan Spurlock, and try something new for 30 days.',
                        'blanks' => [
                            ['word_index' => 9, 'hint' => 'r'],
                            ['word_index' => 19, 'hint' => 'p']
                        ]
                    ],
                    [
                        'id' => 2,
                        'start' => 22.0,
                        'end' => 26.0,
                        'text' => 'The idea is actually pretty simple.',
                        'blanks' => [
                            ['word_index' => 3, 'hint' => 'a'],
                            ['word_index' => 5, 'hint' => 's']
                        ]
                    ],
                    [
                        'id' => 3,
                        'start' => 26.0,
                        'end' => 32.0,
                        'text' => "Think about something you've always wanted to add to your life and try it for the next 30 days.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 'a'],
                            ['word_index' => 12, 'hint' => 'n']
                        ]
                    ],
                    [
                        'id' => 4,
                        'start' => 32.0,
                        'end' => 41.5,
                        'text' => 'It turns out 30 days is just about the right amount of time to add a new habit or subtract a habit -- like watching the news -- from your life.',
                        'blanks' => [
                            ['word_index' => 8, 'hint' => 'a'],
                            ['word_index' => 13, 'hint' => 'h']
                        ]
                    ],
                    [
                        'id' => 5,
                        'start' => 41.5,
                        'end' => 46.0,
                        'text' => 'There are a few things I learned while doing these 30-day challenges.',
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 'l'],
                            ['word_index' => 9, 'hint' => 'c']
                        ]
                    ],
                    [
                        'id' => 6,
                        'start' => 46.0,
                        'end' => 52.0,
                        'text' => 'The first was, instead of the months flying by, forgotten, the time was much more memorable.',
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 'f'],
                            ['word_index' => 12, 'hint' => 'm']
                        ]
                    ],
                    [
                        'id' => 7,
                        'start' => 52.0,
                        'end' => 56.5,
                        'text' => 'This was part of a challenge I did to take a picture every day for a month.',
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 'c'],
                            ['word_index' => 8, 'hint' => 'p']
                        ]
                    ],
                    [
                        'id' => 8,
                        'start' => 56.5,
                        'end' => 60.5,
                        'text' => 'And I remember exactly where I was and what I was doing that day.',
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'r'],
                            ['word_index' => 9, 'hint' => 'd']
                        ]
                    ],
                    [
                        'id' => 9,
                        'start' => 60.5,
                        'end' => 67.5,
                        'text' => 'I also noticed that as I started to do more and harder 30-day challenges, my self-confidence grew.',
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'n'],
                            ['word_index' => 12, 'hint' => 'c']
                        ]
                    ],
                    [
                        'id' => 10,
                        'start' => 67.5,
                        'end' => 74.0,
                        'text' => 'I went from desk-dwelling computer nerd to the kind of guy who bikes to work -- for fun.',
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 'c'],
                            ['word_index' => 11, 'hint' => 'b']
                        ]
                    ],
                    [
                        'id' => 11,
                        'start' => 74.0,
                        'end' => 81.0,
                        'text' => 'Even last year, I ended up hiking up Mt. Kilimanjaro, the highest mountain in Africa.',
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 'h'],
                            ['word_index' => 9, 'hint' => 'h']
                        ]
                    ],
                    [
                        'id' => 12,
                        'start' => 81.0,
                        'end' => 86.5,
                        'text' => 'I would never have been that adventurous before I started my 30-day challenges.',
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 'a'],
                            ['word_index' => 11, 'hint' => 'c']
                        ]
                    ],
                    [
                        'id' => 13,
                        'start' => 86.5,
                        'end' => 93.0,
                        'text' => 'I also figured out that if you really want something badly enough, you can do anything for 30 days.',
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'f'],
                            ['word_index' => 11, 'hint' => 'a']
                        ]
                    ],
                    [
                        'id' => 14,
                        'start' => 93.0,
                        'end' => 96.5,
                        'text' => 'Have you ever wanted to write a novel?',
                        'blanks' => [
                            ['word_index' => 3, 'hint' => 'w'],
                            ['word_index' => 6, 'hint' => 'n']
                        ]
                    ],
                    [
                        'id' => 15,
                        'start' => 96.5,
                        'end' => 104.5,
                        'text' => 'Every November, tens of thousands of people try to write their own 50,000-word novel from scratch in 30 days.',
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 't'],
                            ['word_index' => 14, 'hint' => 's']
                        ]
                    ],
                    [
                        'id' => 16,
                        'start' => 104.5,
                        'end' => 110.0,
                        'text' => 'It turns out, all you have to do is write 1,667 words a day for a month.',
                        'blanks' => [
                            ['word_index' => 9, 'hint' => 'w'],
                            ['word_index' => 13, 'hint' => 'm']
                        ]
                    ],
                    [
                        'id' => 17,
                        'start' => 110.0,
                        'end' => 112.5,
                        'text' => 'So I did.',
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'd']
                        ]
                    ],
                    [
                        'id' => 18,
                        'start' => 112.5,
                        'end' => 118.5,
                        'text' => "By the way, the secret is not to go to sleep until you've written your words for the day.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 's'],
                            ['word_index' => 10, 'hint' => 'w']
                        ]
                    ],
                    [
                        'id' => 19,
                        'start' => 118.5,
                        'end' => 123.0,
                        'text' => "You might be sleep-deprived, but you'll finish your novel.",
                        'blanks' => [
                            ['word_index' => 3, 'hint' => 's'],
                            ['word_index' => 6, 'hint' => 'f']
                        ]
                    ],
                    [
                        'id' => 20,
                        'start' => 123.0,
                        'end' => 126.5,
                        'text' => 'Now, is my book the next great American novel?',
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 'g'],
                            ['word_index' => 8, 'hint' => 'n']
                        ]
                    ],
                    [
                        'id' => 21,
                        'start' => 126.5,
                        'end' => 128.5,
                        'text' => "No, it's awful.",
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'a']
                        ]
                    ],
                    [
                        'id' => 22,
                        'start' => 128.5,
                        'end' => 141.0,
                        'text' => 'But for the rest of my life, if I meet John Hodgman at a TED party, I don\'t have to say, "I\'m a computer scientist." No, no, I can say, "I\'m a novelist."',
                        'blanks' => [
                            ['word_index' => 23, 'hint' => 'c'],
                            ['word_index' => 32, 'hint' => 'n']
                        ]
                    ],
                    [
                        'id' => 23,
                        'start' => 141.0,
                        'end' => 145.0,
                        'text' => "So here's one last thing I'd like to mention.",
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 't'],
                            ['word_index' => 8, 'hint' => 'm']
                        ]
                    ],
                    [
                        'id' => 24,
                        'start' => 145.0,
                        'end' => 153.5,
                        'text' => 'I learned that when I made small, sustainable changes, things I could keep doing, they were more likely to stick.',
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 's'],
                            ['word_index' => 14, 'hint' => 'l']
                        ]
                    ],
                    [
                        'id' => 25,
                        'start' => 153.5,
                        'end' => 157.0,
                        'text' => "There's nothing wrong with big, crazy challenges.",
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'w'],
                            ['word_index' => 6, 'hint' => 'c']
                        ]
                    ],
                    [
                        'id' => 26,
                        'start' => 157.0,
                        'end' => 159.0,
                        'text' => "In fact, they're a ton of fun.",
                        'blanks' => [
                            ['word_index' => 1, 'hint' => 'f'],
                            ['word_index' => 4, 'hint' => 't']
                        ]
                    ],
                    [
                        'id' => 27,
                        'start' => 159.0,
                        'end' => 162.0,
                        'text' => "But they're less likely to stick.",
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'l'],
                            ['word_index' => 5, 'hint' => 's']
                        ]
                    ],
                    [
                        'id' => 28,
                        'start' => 162.0,
                        'end' => 171.0,
                        'text' => 'When I gave up sugar for 30 days, day 31 looked like this.',
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 's'],
                            ['word_index' => 9, 'hint' => 'l']
                        ]
                    ],
                    [
                        'id' => 29,
                        'start' => 171.0,
                        'end' => 175.5,
                        'text' => "So here's my question to you: What are you waiting for?",
                        'blanks' => [
                            ['word_index' => 3, 'hint' => 'q'],
                            ['word_index' => 7, 'hint' => 'w']
                        ]
                    ],
                    [
                        'id' => 30,
                        'start' => 175.5,
                        'end' => 188.0,
                        'text' => "I guarantee you the next 30 days are going to pass whether you like it or not, so why not think about something you've always wanted to try and give it a shot for the next 30 days?",
                        'blanks' => [
                            ['word_index' => 1, 'hint' => 'g'],
                            ['word_index' => 16, 'hint' => 't'],
                            ['word_index' => 25, 'hint' => 's']
                        ]
                    ]
                ]
            ],
            [
                'title' => 'How to Start a Movement (Derek Sivers)',
                'youtube_id' => 'fW8amMCVAJQ',
                'category' => 'TED Talk',
                'difficulty' => 'Hard',
                'duration' => '3:10',
                'description' => 'Simak analisis menarik dari Derek Sivers tentang bagaimana sebuah gerakan sosial dimulai melalui peran penting pengikut pertama.',
                'transcript_data' => [
                    [
                        'id' => 1,
                        'start' => 0.5,
                        'end' => 8.5,
                        'text' => "If you've learned a lot about leadership and making a movement, then let's watch a movement happen, start to finish, in under three minutes, and dissect some lessons from it.",
                        'blanks' => [
                            ['word_index' => 8, 'hint' => 'l'],
                            ['word_index' => 12, 'hint' => 'm']
                        ]
                    ],
                    [
                        'id' => 2,
                        'start' => 9.0,
                        'end' => 16.0,
                        'text' => "First, of course you know, a leader needs the guts to stand out and be ridiculed. But what he's doing is so easy to follow.",
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 'l'],
                            ['word_index' => 13, 'hint' => 'r']
                        ]
                    ],
                    [
                        'id' => 3,
                        'start' => 16.5,
                        'end' => 23.0,
                        'text' => "So here's his first follower with a crucial role; he's going to show everyone else how to follow.",
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 'f'],
                            ['word_index' => 7, 'hint' => 'c']
                        ]
                    ],
                    [
                        'id' => 4,
                        'start' => 23.5,
                        'end' => 28.5,
                        'text' => "Now, notice that the leader embraces him as an equal. So, now it's not about the leader anymore; it's about them, plural.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 'e'],
                            ['word_index' => 8, 'hint' => 'e']
                        ]
                    ],
                    [
                        'id' => 5,
                        'start' => 29.0,
                        'end' => 32.5,
                        'text' => "Now, there he is calling to his friends.",
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 'c'],
                            ['word_index' => 7, 'hint' => 'f']
                        ]
                    ],
                    [
                        'id' => 6,
                        'start' => 33.0,
                        'end' => 42.0,
                        'text' => "Now, if you notice that the first follower is actually an underestimated form of leadership in itself. It takes guts to stand out like that.",
                        'blanks' => [
                            ['word_index' => 8, 'hint' => 'u'],
                            ['word_index' => 10, 'hint' => 'l']
                        ]
                    ],
                    [
                        'id' => 7,
                        'start' => 42.5,
                        'end' => 47.0,
                        'text' => "The first follower is what transforms a lone nut into a leader.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 't'],
                            ['word_index' => 10, 'hint' => 'l']
                        ]
                    ],
                    [
                        'id' => 8,
                        'start' => 47.5,
                        'end' => 51.0,
                        'text' => "And here comes a second follower.",
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 's'],
                            ['word_index' => 5, 'hint' => 'f']
                        ]
                    ],
                    [
                        'id' => 9,
                        'start' => 51.5,
                        'end' => 59.0,
                        'text' => "Now it's not a lone nut, it's not two nuts—three is a crowd, and a crowd is news.",
                        'blanks' => [
                            ['word_index' => 9, 'hint' => 'c'],
                            ['word_index' => 13, 'hint' => 'n']
                        ]
                    ],
                    [
                        'id' => 10,
                        'start' => 59.5,
                        'end' => 63.5,
                        'text' => "So a movement must be public.",
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'm'],
                            ['word_index' => 5, 'hint' => 'p']
                        ]
                    ],
                    [
                        'id' => 11,
                        'start' => 64.0,
                        'end' => 72.0,
                        'text' => "It's important to show not just the leader, but the followers, because you find that new followers emulate the followers, not the leader.",
                        'blanks' => [
                            ['word_index' => 8, 'hint' => 'f'],
                            ['word_index' => 12, 'hint' => 'e']
                        ]
                    ],
                    [
                        'id' => 12,
                        'start' => 72.5,
                        'end' => 78.5,
                        'text' => "Now, here come two more people, and immediately after, three more people.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 'p'],
                            ['word_index' => 7, 'hint' => 'i']
                        ]
                    ],
                    [
                        'id' => 13,
                        'start' => 79.0,
                        'end' => 85.0,
                        'text' => "Now we've got momentum. This is the tipping point. Now we've got a movement.",
                        'blanks' => [
                            ['word_index' => 3, 'hint' => 'm'],
                            ['word_index' => 7, 'hint' => 't']
                        ]
                    ],
                    [
                        'id' => 14,
                        'start' => 85.5,
                        'end' => 91.0,
                        'text' => "So, notice that, as more people join in, it's less risky.",
                        'blanks' => [
                            ['word_index' => 5, 'hint' => 'j'],
                            ['word_index' => 8, 'hint' => 'r']
                        ]
                    ],
                    [
                        'id' => 15,
                        'start' => 91.5,
                        'end' => 97.0,
                        'text' => "So those that were sitting on the fence before, now have no reason not to.",
                        'blanks' => [
                            ['word_index' => 4, 'hint' => 's'],
                            ['word_index' => 10, 'hint' => 'r']
                        ]
                    ],
                    [
                        'id' => 16,
                        'start' => 97.5,
                        'end' => 105.0,
                        'text' => "They won't stand out, they won't be ridiculed, but they will be part of the in-crowd if they hurry.",
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 'r'],
                            ['word_index' => 15, 'hint' => 'h']
                        ]
                    ],
                    [
                        'id' => 17,
                        'start' => 105.5,
                        'end' => 116.0,
                        'text' => "Over the next minute, you'll see the rest who prefer to be part of the crowd, because eventually they'd be ridiculed for not joining.",
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 'p'],
                            ['word_index' => 16, 'hint' => 'j']
                        ]
                    ],
                    [
                        'id' => 18,
                        'start' => 116.5,
                        'end' => 121.5,
                        'text' => "And ladies and gentlemen, that is how a movement is made!",
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 'm']
                        ]
                    ],
                    [
                        'id' => 19,
                        'start' => 122.0,
                        'end' => 134.0,
                        'text' => "But let's recap some lessons from this. So first, if you are the type, like the shirtless dancing guy that is standing alone, remember the importance of nurturing your first few followers as equals so it's clearly about the movement, not you.",
                        'blanks' => [
                            ['word_index' => 15, 'hint' => 'n'],
                            ['word_index' => 20, 'hint' => 'e']
                        ]
                    ],
                    [
                        'id' => 20,
                        'start' => 134.5,
                        'end' => 139.0,
                        'text' => "But, we might have missed the real lesson here.",
                        'blanks' => [
                            ['word_index' => 6, 'hint' => 'm']
                        ]
                    ],
                    [
                        'id' => 21,
                        'start' => 139.5,
                        'end' => 146.0,
                        'text' => "The biggest lesson, if you noticed — did you catch it? — is that leadership is over-glorified.",
                        'blanks' => [
                            ['word_index' => 2, 'hint' => 'b'],
                            ['word_index' => 3, 'hint' => 'l']
                        ]
                    ],
                    [
                        'id' => 22,
                        'start' => 146.5,
                        'end' => 152.0,
                        'text' => "Yes, the shirtless guy was the leader, and he gets all the credit, but it was really the first follower that transformed a lone nut into a leader.",
                        'blanks' => [
                            ['word_index' => 9, 'hint' => 'c'],
                            ['word_index' => 17, 'hint' => 't']
                        ]
                    ],
                    [
                        'id' => 23,
                        'start' => 152.5,
                        'end' => 158.0,
                        'text' => "There is no movement without the first follower. We're told we all need to be leaders, but that would be really ineffective.",
                        'blanks' => [
                            ['word_index' => 3, 'hint' => 'm'],
                            ['word_index' => 6, 'hint' => 'f']
                        ]
                    ],
                    [
                        'id' => 24,
                        'start' => 158.5,
                        'end' => 165.0,
                        'text' => "The best way to make a movement, if you really care, is to courageously follow and show others how to follow.",
                        'blanks' => [
                            ['word_index' => 10, 'hint' => 'c'],
                            ['word_index' => 11, 'hint' => 'f']
                        ]
                    ],
                    [
                        'id' => 25,
                        'start' => 165.5,
                        'end' => 173.0,
                        'text' => "And when you find a lone nut doing something great, have the guts to be the first one to stand up and join in.",
                        'blanks' => [
                            ['word_index' => 9, 'hint' => 'g'],
                            ['word_index' => 16, 'hint' => 'j']
                        ]
                    ],
                    [
                        'id' => 26,
                        'start' => 173.5,
                        'end' => 178.0,
                        'text' => "Thank you.",
                        'blanks' => [
                            ['word_index' => 0, 'hint' => 't']
                        ]
                    ]
                ]
            ]
        ];

        foreach ($videos as $video) {
            PracticeVideo::create($video);
        }
    }
}
