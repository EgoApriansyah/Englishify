<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Passage;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data to avoid duplicates
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Passage::truncate();
        Question::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $orderNumber = 1;

        // ==========================================
        // 1. LISTENING COMPREHENSION (18 Questions)
        // ==========================================
        $listeningQuestions = [
            // --- Part A (10 Questions) ---
            [
                'section' => 'listening',
                'sub_type' => 'short_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'He knew that cherries were pricier than.',
                'option_b' => 'He bought cherries and grapes because of not knowing their prices.',
                'option_c' => 'He didn\'t know that cherries were pricier than grapes',
                'option_d' => 'He didn\'t buy either grapes or cherries because both were pricy.',
                'correct_answer' => 'C',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'short_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'She felt it wasn’t fair.',
                'option_b' => 'She was in rage.',
                'option_c' => 'She felt inferior.',
                'option_d' => 'She wasn\'t furious.',
                'correct_answer' => 'B',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'short_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'He is unhappy at the thought of retiring.',
                'option_b' => 'He hates to leave his job soon.',
                'option_c' => 'He is retiring too fast.',
                'option_d' => 'He is eager to leave his job.',
                'correct_answer' => 'D',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'short_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'The rent was given by her for Tom.',
                'option_b' => 'She was asked money for paying the rent.',
                'option_c' => 'Tom gave her money for the rent.',
                'option_d' => 'The money was lent by Tom early this month.',
                'correct_answer' => 'C',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'short_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'She shouldn\'t leave her purse here.',
                'option_b' => 'She\'s probably in the apartment.',
                'option_c' => 'Her purse must not be in the apartment.',
                'option_d' => 'She left the apartment without taking her purse',
                'correct_answer' => 'B',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'short_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'Chuck looked at him in the hospital.',
                'option_b' => 'Chuck didn\'t seem to be doing very well.',
                'option_c' => 'This visit was better than the last.',
                'option_d' => 'Chuck had improved.',
                'correct_answer' => 'D',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'short_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'She didn’t think that he’d do the dishes.',
                'option_b' => 'The plates did not need to be washed.',
                'option_c' => 'She asked him to be ready to go.',
                'option_d' => 'The dishes would not be done.',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'short_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'Professor described the lesson for his class.',
                'option_b' => 'There was a long line to register for the required class.',
                'option_c' => 'Professor’s requirement for the course is high.',
                'option_d' => 'Professor required the class to outline his course.',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'short_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'She\'s shopping for a carpet.',
                'option_b' => 'She needs to help him find something.',
                'option_c' => 'She\'s found a new ring.',
                'option_d' => 'She\'s thankful she has a rag.',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'short_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'She ran into another car at the corner.',
                'option_b' => 'She ran to her cousin because she’s scared.',
                'option_c' => 'She unexpectedly met one of her relatives.',
                'option_d' => 'Carl was running from place to place.',
                'correct_answer' => 'C',
            ],

            // --- Part B (4 Questions) ---
            [
                'section' => 'listening',
                'sub_type' => 'long_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'Trash orbiting Earth.',
                'option_b' => 'Becoming space scientists.',
                'option_c' => 'A trip by an astronaut to the Moon.',
                'option_d' => 'The overabundance of garbage on Earth.',
                'correct_answer' => 'D',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'long_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'From a lecture.',
                'option_b' => 'On a television program.',
                'option_c' => 'In a magazine article.',
                'option_d' => 'In a book.',
                'correct_answer' => 'B',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'long_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => '3,000 tons',
                'option_b' => '3,000 pounds',
                'option_c' => '13,000 pounds',
                'option_d' => '300 tons',
                'correct_answer' => 'B',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'long_conversation',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'The problem will take care of itself.',
                'option_b' => 'Scientists will find solutions to the problem.',
                'option_c' => 'She will be able to travel in space.',
                'option_d' => 'The junk will fall to Earth.',
                'correct_answer' => 'B',
            ],

            // --- Part C (4 Questions) ---
            [
                'section' => 'listening',
                'sub_type' => 'talk',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'On the first day of class',
                'option_b' => 'In the final week of the semester',
                'option_c' => 'In the middle of the semester',
                'option_d' => 'At the end of class',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'talk',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'In two weeks',
                'option_b' => 'In three weeks',
                'option_c' => 'Later today',
                'option_d' => 'By Friday of this week',
                'correct_answer' => 'D',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'talk',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'Books listed in student journals',
                'option_b' => 'Books from outside the library',
                'option_c' => 'Both books and journals',
                'option_d' => 'Journal and magazine articles',
                'correct_answer' => 'C',
            ],
            [
                'section' => 'listening',
                'sub_type' => 'talk',
                'transcript' => null,
                'question_text' => 'Pilihlah jawaban yang paling tepat berdasarkan rekaman audio.',
                'option_a' => 'Two',
                'option_b' => 'Three',
                'option_c' => 'Five',
                'option_d' => 'Seven',
                'correct_answer' => 'D',
            ],
        ];

        foreach ($listeningQuestions as $q) {
            $q['order_number'] = $orderNumber++;
            Question::create($q);
        }

        // =======================================================
        // 2. STRUCTURE & WRITTEN EXPRESSION (20 Questions)
        // =======================================================
        $structureQuestions = [
            // --- Structure (10 Questions - Fill in the blank) ---
            [
                'section' => 'structure',
                'sub_type' => 'structure',
                'question_text' => 'The geographic center of the United States ___ in North Dakota, but rather in Lebanon, Kansas.',
                'option_a' => 'is not located',
                'option_b' => 'not located',
                'option_c' => 'which is not located',
                'option_d' => 'being not located',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'structure',
                'question_text' => '___ standard time zones was proposed by Sandford Fleming in 1876.',
                'option_a' => 'The system of',
                'option_b' => 'For the system of',
                'option_c' => 'That the system of',
                'option_d' => 'It was the system of',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'structure',
                'question_text' => 'Not only ___ light, but it also generates heat when electricity passes through it.',
                'option_a' => 'does the filament produce',
                'option_b' => 'the filament produces',
                'option_c' => 'produces the filament',
                'option_d' => 'the filament does produce',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'structure',
                'question_text' => 'The active volcano, ___ in Hawaii, attracts thousands of tourists every year.',
                'option_a' => 'situated',
                'option_b' => 'is situated',
                'option_c' => 'which situated',
                'option_d' => 'it is situated',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'structure',
                'question_text' => 'The more complex a molecule is, ___ its properties are to predict.',
                'option_a' => 'the more difficult',
                'option_b' => 'it is more difficult',
                'option_c' => 'more difficult',
                'option_d' => 'difficulty is more',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'structure',
                'question_text' => '___ native to North America, the grizzly bear is now found primarily in Alaska and Canada.',
                'option_a' => 'Once',
                'option_b' => 'When was',
                'option_c' => 'That it was',
                'option_d' => 'Because of',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'structure',
                'question_text' => 'In the deep ocean, where sunlight cannot penetrate, organisms must ___ to extreme pressure and darkness.',
                'option_a' => 'adapt',
                'option_b' => 'adapting',
                'option_c' => 'adaptation',
                'option_d' => 'adapted',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'structure',
                'question_text' => '___ of the committee, Dr. Green chaired the discussion on environmental policy.',
                'option_a' => 'As chairperson',
                'option_b' => 'He was chairperson',
                'option_c' => 'Because chairperson',
                'option_d' => 'For chairperson',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'structure',
                'question_text' => 'Bioluminescent mushrooms, ___ grow on decaying wood, illuminate the forest floor at night.',
                'option_a' => 'which',
                'option_b' => 'they',
                'option_c' => 'whose',
                'option_d' => 'there',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'structure',
                'question_text' => 'Only after the storm subsided ___ to inspect the damage to their homes.',
                'option_a' => 'did the residents return',
                'option_b' => 'the residents returned',
                'option_c' => 'returned the residents',
                'option_d' => 'the residents did return',
                'correct_answer' => 'A',
            ],

            // --- Written Expression (10 Questions - Identify the grammatically incorrect phrase) ---
            [
                'section' => 'structure',
                'sub_type' => 'written_expression',
                'question_text' => 'The [majority] (A) of the [peoples] (B) living in the coastal region [rely] (C) on [fishing] (D) for their livelihood.',
                'option_a' => 'majority',
                'option_b' => 'peoples',
                'option_c' => 'rely',
                'option_d' => 'fishing',
                'correct_answer' => 'B',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'written_expression',
                'question_text' => 'Although she [has] (A) studied piano [for] (B) many years, she [plays] (C) it very [good] (D).',
                'option_a' => 'has',
                'option_b' => 'for',
                'option_c' => 'plays',
                'option_d' => 'good',
                'correct_answer' => 'D',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'written_expression',
                'question_text' => 'Many of the [information] (A) in the report [was] (B) outdated, [making] (C) it difficult to form [a] (D) conclusion.',
                'option_a' => 'Many',
                'option_b' => 'was',
                'option_c' => 'making',
                'option_d' => 'a',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'written_expression',
                'question_text' => 'The team [has] (A) decided to [postponed] (B) the meeting [until] (C) next [Monday] (D).',
                'option_a' => 'has',
                'option_b' => 'postponed',
                'option_c' => 'until',
                'option_d' => 'Monday',
                'correct_answer' => 'B',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'written_expression',
                'question_text' => 'Light [travels] (A) much [more faster] (B) than sound, [which] (C) explains why lightning is [seen] (D) before thunder.',
                'option_a' => 'travels',
                'option_b' => 'more faster',
                'option_c' => 'which',
                'option_d' => 'seen',
                'correct_answer' => 'B',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'written_expression',
                'question_text' => 'The [results] (A) of the experiment [were] (B) similar [to] (C) the [former] (D) study.',
                'option_a' => 'results',
                'option_b' => 'were',
                'option_c' => 'to',
                'option_d' => 'former',
                'correct_answer' => 'D',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'written_expression',
                'question_text' => 'Neither the teacher [nor] (A) the students [was] (B) able [to solve] (C) the complex puzzle [quickly] (D).',
                'option_a' => 'nor',
                'option_b' => 'was',
                'option_c' => 'to solve',
                'option_d' => 'quickly',
                'correct_answer' => 'B',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'written_expression',
                'question_text' => 'To [success] (A) in the business world, one [must] (B) be willing to [adapt] (C) to [changing] (D) market conditions.',
                'option_a' => 'success',
                'option_b' => 'must',
                'option_c' => 'adapt',
                'option_d' => 'changing',
                'correct_answer' => 'A',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'written_expression',
                'question_text' => 'The [large] (A) database [allows] (B) users to search [efficient] (C) for [various] (D) research papers.',
                'option_a' => 'large',
                'option_b' => 'allows',
                'option_c' => 'efficient',
                'option_d' => 'various',
                'correct_answer' => 'C',
            ],
            [
                'section' => 'structure',
                'sub_type' => 'written_expression',
                'question_text' => 'The government [recently] (A) announced a [new] (B) policy [designing] (C) to reduce [carbon] (D) emissions.',
                'option_a' => 'recently',
                'option_b' => 'new',
                'option_c' => 'designing',
                'option_d' => 'carbon',
                'correct_answer' => 'C',
            ],
        ];

        foreach ($structureQuestions as $q) {
            $q['order_number'] = $orderNumber++;
            Question::create($q);
        }

        // ==========================================
        // 3. READING COMPREHENSION (35 Questions)
        // ==========================================

        // --- Passage 1: Photosynthesis & Plant Evolution (9 Questions) ---
        $p1 = Passage::create([
            'title' => 'Photosynthesis and the Oxygenation of Earth',
            'content' => "Photosynthesis is the fundamental biological process by which green plants, algae, and certain bacteria convert light energy into chemical energy, utilizing carbon dioxide and water to produce glucose and oxygen. The emergence of photosynthetic organisms, particularly cyanobacteria, roughly 2.4 billion years ago, was a pivotal event in Earth's history, initiating what is known as the Great Oxidation Event. Prior to this epoch, Earth's atmosphere was largely anaerobic, composed of methane, ammonia, and carbon dioxide.\n\nAs photosynthetic life proliferated in the oceans, the accumulation of oxygen as a byproduct fundamentally transformed the planet's geosphere and biosphere. Initially, the produced oxygen reacted with dissolved iron in the seas, creating massive banded iron formations. Once the oceanic iron sinks were saturated, oxygen began escaping into the atmosphere. This atmospheric oxygenation precipitated a mass extinction of obligate anaerobic microbes, for whom oxygen was toxic. However, it simultaneously paved the way for the evolution of complex, multicellular aerobic organisms. Over millions of years, the accumulation of atmospheric oxygen also led to the formation of the ozone layer, which screens out harmful ultraviolet radiation and enabled life to transition from aquatic environments onto land.",
        ]);

        $p1Questions = [
            [
                'question_text' => 'What is the main topic of the passage?',
                'option_a' => 'The chemical formula of glucose.',
                'option_b' => 'The role of photosynthesis in Earth\'s atmospheric history.',
                'option_c' => 'The extinction of ancient anaerobic organisms.',
                'option_d' => 'The formation of iron formations in the sea.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'According to the passage, when did photosynthetic organisms first emerge?',
                'option_a' => '2.4 billion years ago',
                'option_b' => '1.2 billion years ago',
                'option_c' => '4.5 billion years ago',
                'option_d' => '360 million years ago',
                'correct_answer' => 'A',
            ],
            [
                'question_text' => 'The word "pivotal" in paragraph 1 is closest in meaning to:',
                'option_a' => 'gradual',
                'option_b' => 'crucial',
                'option_c' => 'insignificant',
                'option_d' => 'dangerous',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'Before the Great Oxidation Event, what was Earth\'s atmosphere primarily composed of?',
                'option_a' => 'Oxygen, nitrogen, and argon',
                'option_b' => 'Methane, ammonia, and carbon dioxide',
                'option_c' => 'Ozone and water vapor',
                'option_d' => 'Pure helium and hydrogen',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What first happened to the oxygen produced by early photosynthetic life?',
                'option_a' => 'It escaped directly into the atmosphere.',
                'option_b' => 'It reacted with dissolved iron in the oceans.',
                'option_c' => 'It was consumed by anaerobic bacteria.',
                'option_d' => 'It created the ozone layer immediately.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'Why did the Great Oxidation Event cause a mass extinction?',
                'option_a' => 'The Earth\'s temperature cooled down dramatically.',
                'option_b' => 'Oxygen was toxic to obligate anaerobic microbes.',
                'option_c' => 'Sunlight could no longer reach the ocean floor.',
                'option_d' => 'Plants consumed all the available carbon dioxide.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'The word "precipitated" in paragraph 2 is closest in meaning to:',
                'option_a' => 'prevented',
                'option_b' => 'triggered',
                'option_c' => 'delayed',
                'option_d' => 'predicted',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What can be inferred about the transition of life to land?',
                'option_a' => 'It occurred before the oceans were saturated with iron.',
                'option_b' => 'It was made possible by the formation of the protective ozone layer.',
                'option_c' => 'It was delayed by the presence of aerobic organisms.',
                'option_d' => 'It happened independently of atmospheric oxygen levels.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'Which of the following is NOT mentioned as a reactant or product of photosynthesis?',
                'option_a' => 'Carbon dioxide',
                'option_b' => 'Water',
                'option_c' => 'Nitrogen gas',
                'option_d' => 'Glucose',
                'correct_answer' => 'C',
            ],
        ];

        foreach ($p1Questions as $q) {
            $q['passage_id'] = $p1->id;
            $q['section'] = 'reading';
            $q['sub_type'] = 'reading';
            $q['order_number'] = $orderNumber++;
            Question::create($q);
        }

        // --- Passage 2: The Industrial Revolution (9 Questions) ---
        $p2 = Passage::create([
            'title' => 'The Genesis of the Industrial Revolution',
            'content' => "The Industrial Revolution, which commenced in Great Britain during the late 18th century, marked a profound transition from agrarian, handicraft economies to ones dominated by industry and machine manufacturing. Several converging factors made Britain the birthplace of this transformation. First, the country possessed abundant deposits of coal and iron ore, which were crucial for powering steam engines and constructing machinery. Second, the Agricultural Revolution of the preceding decades had increased food production, leading to population growth and a surplus of labor as fewer people were needed to work the land.\n\nCrucial technological innovations acted as catalysts. James Watt's improvements to the steam engine in the 1770s allowed it to be applied to drive machinery in textile mills, breweries, and factories, liberating manufacturing from geographic constraints such as fast-flowing rivers. Additionally, mechanization in the textile industry—such as the spinning jenny and the power loom—exponentially increased production speeds. The development of steam-powered locomotives and steamships revolutionized transportation, enabling the rapid movement of raw materials and finished goods. This industrial growth stimulated urbanization, as rural laborers migrated to rapidly expanding cities in search of factory work, fundamentally reshaping the social structure.",
        ]);

        $p2Questions = [
            [
                'question_text' => 'What is the main focus of the passage?',
                'option_a' => 'The life and inventions of James Watt.',
                'option_b' => 'The factors and innovations that initiated the Industrial Revolution.',
                'option_c' => 'The negative social effects of urbanization in Great Britain.',
                'option_d' => 'The history of textile manufacturing in Europe.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'Which resources were essential for powering steam engines and making machinery?',
                'option_a' => 'Wood and copper',
                'option_b' => 'Coal and iron ore',
                'option_c' => 'Oil and natural gas',
                'option_d' => 'Water and wind energy',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'The word "surplus" in paragraph 1 is closest in meaning to:',
                'option_a' => 'shortage',
                'option_b' => 'excess',
                'option_c' => 'demand',
                'option_d' => 'decrease',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'How did the Agricultural Revolution contribute to the Industrial Revolution?',
                'option_a' => 'It provided capital through crop sales to colonies.',
                'option_b' => 'It created population growth and a surplus of labor for factories.',
                'option_c' => 'It led to the invention of the steam engine.',
                'option_d' => 'It discouraged rural laborers from migrating to the cities.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What major improvement did James Watt make in the 1770s?',
                'option_a' => 'He invented the spinning jenny.',
                'option_b' => 'He improved the efficiency of the steam engine.',
                'option_c' => 'He built the first steam locomotive.',
                'option_d' => 'He designed the power loom.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'Before Watt\'s improvements, how were early factories generally restricted geographically?',
                'option_a' => 'They had to be near coal mines.',
                'option_b' => 'They had to be located near fast-flowing rivers for water power.',
                'option_c' => 'They were forced to stay in major agricultural regions.',
                'option_d' => 'They could only be built in coastal seaport towns.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'The word "mechanization" in paragraph 2 is closest in meaning to:',
                'option_a' => 'manual labor',
                'option_b' => 'use of machinery',
                'option_c' => 'handicraft production',
                'option_d' => 'agricultural techniques',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What effect did steam locomotives and steamships have on commerce?',
                'option_a' => 'They decreased the demand for raw materials.',
                'option_b' => 'They allowed for the rapid transit of materials and goods.',
                'option_c' => 'They forced merchants to rely on local trade.',
                'option_d' => 'They increased the cost of shipping goods.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What was a major social consequence of the industrial growth mentioned?',
                'option_a' => 'A decline in overall population growth.',
                'option_b' => 'Migration of rural laborers to rapidly expanding cities.',
                'option_c' => 'The dissolution of the factory system.',
                'option_d' => 'An increase in agricultural employment.',
                'correct_answer' => 'B',
            ],
        ];

        foreach ($p2Questions as $q) {
            $q['passage_id'] = $p2->id;
            $q['section'] = 'reading';
            $q['sub_type'] = 'reading';
            $q['order_number'] = $orderNumber++;
            Question::create($q);
        }

        // --- Passage 3: Coral Reef Ecosystems (9 Questions) ---
        $p3 = Passage::create([
            'title' => 'The Ecological Importance of Coral Reefs',
            'content' => "Coral reefs are among the most diverse and productive ecosystems on the planet, often referred to as the \"rainforests of the sea.\" Although they cover less than 0.1% of the ocean floor, they support more than 25% of all marine species, including fish, mollusks, crustaceans, and sponges. The physical structure of a reef is constructed from calcium carbonate secreted by tiny colonial animals called coral polyps. These polyps live in a symbiotic relationship with photosynthetic microalgae called zooxanthellae, which reside within the coral tissues. The algae provide the corals with glucose and amino acids, while the coral provides the algae with a protected environment and carbon dioxide.\n\nHowever, coral reefs are highly sensitive to environmental fluctuations. When sea temperatures rise even slightly, corals experience physiological stress and expel their zooxanthellae. Because the zooxanthellae give corals their vibrant colors, their loss reveals the white calcium carbonate skeleton, a phenomenon known as coral bleaching. Without the symbiotic algae, corals are deprived of their primary energy source, making them susceptible to disease and starvation. If the high temperatures persist, the corals die, causing the entire reef structure to degrade. This loss has catastrophic consequences, destroying critical fisheries, leaving coastlines vulnerable to erosion, and severely impacting tourism-dependent economies.",
        ]);

        $p3Questions = [
            [
                'question_text' => 'Why are coral reefs referred to as the "rainforests of the sea"?',
                'option_a' => 'They receive high amounts of underwater rainfall.',
                'option_b' => 'They support a vast diversity of marine species despite their small area.',
                'option_c' => 'They are primarily made of tropical seaweed.',
                'option_d' => 'They are found only in tropical rainforest climates.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What creates the physical structure of a coral reef?',
                'option_a' => 'Volcanic rock deposits.',
                'option_b' => 'Calcium carbonate secreted by coral polyps.',
                'option_c' => 'Hardened ocean sand.',
                'option_d' => 'Decaying organic matter from marine fish.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'The word "symbiotic" in paragraph 1 describes a relationship that is:',
                'option_a' => 'predatory',
                'option_b' => 'mutually beneficial',
                'option_c' => 'harmful to both',
                'option_d' => 'temporary',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What do zooxanthellae provide to coral polyps?',
                'option_a' => 'Calcium carbonate and protection',
                'option_b' => 'Glucose and amino acids',
                'option_c' => 'Carbon dioxide and shelter',
                'option_d' => 'Vibrant pigments for camouflage',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'According to the passage, what is the primary trigger of coral bleaching?',
                'option_a' => 'An increase in ocean acidity.',
                'option_b' => 'An elevation in sea temperatures.',
                'option_c' => 'Overfishing near the reefs.',
                'option_d' => 'A lack of carbon dioxide in the water.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What actually happens during the process of coral bleaching?',
                'option_a' => 'Corals secrete white paint to reflect solar heat.',
                'option_b' => 'Corals expel their symbiotic zooxanthellae.',
                'option_c' => 'Algae consume the coral polyp tissue.',
                'option_d' => 'Fish eat the colorful outer layer of the corals.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'The word "susceptible" in paragraph 2 is closest in meaning to:',
                'option_a' => 'immune',
                'option_b' => 'vulnerable',
                'option_c' => 'indifferent',
                'option_d' => 'resistant',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What is a consequence of persistent coral death on human coastal communities?',
                'option_a' => 'It leads to higher sea levels globally.',
                'option_b' => 'It leaves coastlines more vulnerable to erosion.',
                'option_c' => 'It increases the availability of commercial fish.',
                'option_d' => 'It improves sandy beaches for tourism.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'Which of the following ocean floor percentages is occupied by coral reefs?',
                'option_a' => '25%',
                'option_b' => 'less than 0.1%',
                'option_c' => 'exactly 10%',
                'option_d' => 'more than 50%',
                'correct_answer' => 'B',
            ],
        ];

        foreach ($p3Questions as $q) {
            $q['passage_id'] = $p3->id;
            $q['section'] = 'reading';
            $q['sub_type'] = 'reading';
            $q['order_number'] = $orderNumber++;
            Question::create($q);
        }

        // --- Passage 4: History of Artificial Intelligence (8 Questions) ---
        $p4 = Passage::create([
            'title' => 'The Evolution of Artificial Intelligence',
            'content' => "The intellectual roots of artificial intelligence (AI) can be traced to classical philosophers who attempted to describe human thinking as a symbolic system. However, the field was formally founded in 1956 at a workshop at Dartmouth College, where the term \"artificial intelligence\" was coined. Early pioneers were highly optimistic, predicting that machines capable of simulating human intelligence would be constructed within a generation. Government agencies poured funding into the research, focusing on symbolic logic and natural language translation.\n\nThis early optimism proved premature. Researchers encountered significant barriers, including limited computational power and the lack of digital data. These difficulties led to the first \"AI winter\" in the 1970s, a period marked by a drastic reduction in funding and interest. The field experienced a brief resurgence in the 1980s with \"expert systems\" that mimicked corporate decision-making, followed by another funding collapse. The modern breakthrough came in the 21st century, propelled by the rise of big data, powerful parallel computing hardware (such as GPUs), and advanced machine learning algorithms. Instead of pre-programming rules, researchers began training neural networks on massive datasets, enabling applications to recognize images, translate languages, and beat human champions at complex strategic games.",
        ]);

        $p4Questions = [
            [
                'question_text' => 'Where was the field of artificial intelligence formally founded in 1956?',
                'option_a' => 'Stanford University',
                'option_b' => 'Dartmouth College',
                'option_c' => 'Oxford University',
                'option_d' => 'Massachusetts Institute of Technology',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What did early AI pioneers predict would happen within a generation?',
                'option_a' => 'Computers would replace all human workers.',
                'option_b' => 'Machines capable of simulating human intelligence would be built.',
                'option_c' => 'The Internet would link all global computers.',
                'option_d' => 'A global funding freeze would occur.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'The word "premature" in paragraph 2 is closest in meaning to:',
                'option_a' => 'accurate',
                'option_b' => 'too early',
                'option_c' => 'realistic',
                'option_d' => 'belated',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What caused the first "AI winter" in the 1970s?',
                'option_a' => 'Global weather changes that affected universities.',
                'option_b' => 'Limited computing power and lack of digital data.',
                'option_c' => 'The rise of neural network architectures.',
                'option_d' => 'A shift in focus towards hardware manufacturing.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'Which system experienced a brief popularity during the 1980s?',
                'option_a' => 'Deep neural networks',
                'option_b' => 'Expert systems',
                'option_c' => 'Graphic Processing Units',
                'option_d' => 'Big data processors',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'The word "resurgence" in paragraph 2 is closest in meaning to:',
                'option_a' => 'decline',
                'option_b' => 'revival',
                'option_c' => 'failure',
                'option_d' => 'expansion',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'What three factors propelled the 21st-century breakthrough in AI?',
                'option_a' => 'Symbolic logic, rule-based systems, and government grants.',
                'option_b' => 'Big data, powerful parallel hardware, and machine learning.',
                'option_c' => 'Microprocessor size, analog circuits, and expert systems.',
                'option_d' => 'Dartmouth College workshops, local funding, and translation tools.',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'How does modern AI training differ from early approach?',
                'option_a' => 'It relies strictly on manually pre-programmed rules.',
                'option_b' => 'It trains neural networks on massive datasets rather than pre-programming rules.',
                'option_c' => 'It avoids using any parallel processing hardware.',
                'option_d' => 'It focuses primarily on symbolic logic.',
                'correct_answer' => 'B',
            ],
        ];

        foreach ($p4Questions as $q) {
            $q['passage_id'] = $p4->id;
            $q['section'] = 'reading';
            $q['sub_type'] = 'reading';
            $q['order_number'] = $orderNumber++;
            Question::create($q);
        }
    }
}
