<?php

class message {

    const LIMIT_LOGIN = 3;
    const LIMIT_MESSAGE = 10;
    private $login;
    private $message;
    private $date;

    public static function fromJSON(string $json): Message
    {
        $data = json_decode($json, true);
            return new self($data['login'], $data['message'], new DateTime("@" . $data['date']));
    }

    public function __construct(string $login, string $message, ?DateTime $date = null){

        $this->login = $login;
        $this->message = $message;
        $this->date = $date ?: new DateTime();
    }

    public function isValid (): bool
    {
      return  empty($this->getErrors());
    } 
    
    public function getErrors(): array
    {
        $errors = [];
        if (strlen($this->login) < self::LIMIT_LOGIN){
            $errors['login'] = 'Votre login est trop court';
        }

        if(strlen($this->message) < self::LIMIT_MESSAGE){
            $errors['message'] = 'Votre message est trop court';
        }
    return $errors;    
    }

    public function toHTML(): string
    {
        $login = htmlentities($this->login);
        $this->date->setTimezone(new DateTimeZone('Europe/Paris'));
        $date = $this->date->format('d/m/Y à H:i');
        $message = nl2br(htmlentities($this->message));
        return <<<HTML

    <p>
    <strong>{$login}</strong> <em>le {$date}</em><br>
    {$message}
    </p>
    HTML;
    }

    public function toJSON(): string
    {
       return  json_encode([
            'login' => $this->login,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
        ]);
    }

}

?>