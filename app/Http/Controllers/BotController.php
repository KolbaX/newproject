<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Order;

class BotController extends Controller
{
    public function initBot ()
    {
        // Инициализация бота

        try {
            $bot = new \TelegramBot\Api\Client(setting('site.token_bot'));

            //Handle /ping command
            $bot->command('ping', function ($message) use ($bot) {
                $text = '🏓 ID чата: <b><code>'.$message->getChat()->getId().'</code></b>';
                $bot->sendMessage($message->getChat()->getId(), $text, 'HTML');
            });

            $bot->run();

        } catch (\TelegramBot\Api\Exception $e) {
            // dd($e);
            echo $e->getMessage();
        }
    }

    public function sendMessageOrder (Order $order)
    {
        $bot = new \TelegramBot\Api\Client(setting('site.token_bot'));

        $message = "🎊 Новый заказ: <b>".$order->id."</b>\n\n";
        $message .= "Сумма: <b>".$order->sum."</b> USD \n";
        $message .= "Дата: <b>".date('d.m.Y H:i', strtotime($order->created_at))."</b>\n\n";
        $message .= "<a href='https://".$_SERVER['SERVER_NAME']."/admin/orders/".$order->id."/edit'>Перейти ↗️</a>";

        $bot->sendMessage(setting('site.chat_id_bot'), $message, 'HTML');
    }
}
