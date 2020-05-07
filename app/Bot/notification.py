import sys
import telebot
from key import BOT_KEY

bot = telebot.TeleBot(BOT_KEY)

def send_notifications():
    print(sys.argv)
    # bot.send_message(message.chat.id, 'Привет, ты написал мне /start')
    pass

if __name__ == "__main__":
    send_notifications()
