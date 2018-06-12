<?php

use App\User;
use Illuminate\Database\Seeder;

class ThemesTableSeeder extends Seeder
{
   private static $data = [
        'Вопросы по системе' => [
            'Откуда взяты начальные вопросы?' => 'Стартовые вопросы взяты из разборов на сайте meduza.io.',
            'Что это за сайт?' => 'Это сервис вопросов и ответов.'
        ],
        'Компьютеры и интернет' => [
            'Почему у РКН не получается заблокировать Telegram?' => '

Потому что это сложно. Что значит заблокировать мессенджер? Это значит заблокировать IP-адреса всех серверов, которые сервис использует для связи с внешним миром. Роскомнадзор отслеживает, к каким серверам обращается Telegram, и блокирует их целыми блоками — именно из-за этого под блокировкой оказались миллионы IP-адресов, предоставляемых компаниями Amazon и Google.
Беда в том, что среди блоков заблокированных IP-адресов оказались и те, которые используют другие сервисы и компании. Перебои возникли у мессенджера Viber, онлайн-школы Skyeng и других. Генеральный директор курьерской службы «Птичка» Владимир Кобзев рассказал, что из-за действий Роскомнадзора его сервис простаивал шесть часов и он собирается подавать в суд.',
            'В России и так часто блокируют сайты. Новый законопроект как-то изменит ситуацию?' => '
Да. Если законопроект примут, риски для СМИ вырастут. Легко можно себе представить ситуацию, когда российский суд признает порочащей публикацию о каком-нибудь высокопоставленном герое журналистского расследования и на этом основании требует удалить всю публикацию. А если издание откажется, его могут просто заблокировать.
Важно заметить, что законопроект бьет и по иностранным изданиям. Те нормы, которые позволяют блокировать сайты сейчас, относятся только к изданиям, подчиняющимся российскому законодательству. Но если примут новые поправки, ничто не запрещает какому-нибудь чиновнику или бизнесмену подать в суд, к примеру, на The Nеw York Times или The Guardian и добиться решения в свою пользу (подобные иски уже были). А потом Роскомнадзор должен будет заблокировать сайты этих изданий, если они откажутся удалять публикацию.'     ],
        'Здоровье' => [
            'Какой вид спорта самый полезный?' => 'Тот, который вам больше нравится — главное, чтобы он был достаточно активным. Исследователи не раз пытались понять, какие физические нагрузки приносят больше всего пользы и меньше всего вреда, но к единому мнению прийти не получилось. Крупные медицинские организации не отдают предпочтений какому-то одному виду спорта и предлагают на выбор все: от ходьбы до хоккея — выбирайте сами, чем приятнее заниматься.',
            'Говорят, нельзя запивать еду. Это правда?' => 'Нет. Врачи считают, что вода во время или после еды помогает пищеварению, разрушает еду — и в результате тело лучше усваивает питательные вещества. Другое заблуждение: питье во время еды якобы подавляет выработку слюны. Гастроэнтерологи в ответ на это приводят в пример синдром Шегрена: при этом заболевании плохо выделяется слюна — и пациентов заставляют много пить или хотя бы полоскать рот, не опасаясь, что слюны будет выделяться еще меньше. ',
            'Что страшного в микропластике?' => 'Если коротко, у исследователей есть серьезные основания предполагать, что микропластик может быть вреден животным и людям. Микропластик попадает в пищевые цепочки, когда его поедают животные (от зоопланктона до рыб и птиц), и может накапливаться в тканях живых организмов. В пластике часто есть токсичные примеси, например, красители и огнестойкие добавки, которые попадают в пищеварительную систему животных и могут вызывать повреждения органов, воспаление кишечника и влиять на репродукцию. К тому же, микрочастицы легко впитывают другие токсичные вещества, например, пестициды и диоксины, а потом так же легко выделяют их в организм, в который они попали. '
            
        ],              
    ];
   public function run()
    {
        foreach(self::$data as $theme => $questions) {
            $tid = DB::table('themes')->insertGetId([
                'name' => $theme,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
            
            $user = User::where('name','admin')->first();
            $uid = $user->id;
                
            foreach ($questions as $question => $answer) {
                $qid = DB::table('questions')->insertGetId([
                    'author' => 'admin',
                    'author_email' => 'admin@admin.com',
                    'theme_id' => $tid,
                    'name' => $question,
                    'status_id' => 2,
                    'question_created' => date("Y-m-d H:i:s"),
                    'answer_created' => date("Y-m-d H:i:s"),
                    'answer_updated' => date("Y-m-d H:i:s"),
                    'answer' => $answer,
                    'user_id' =>$uid,
                    
                ]); 
             

                
            }

        }

    }
}
