<?php

class Studente
{
    private string $nome;
    private int $eta;
    private static int $num = 5;

    /**
     * @param string $nome
     * @param int $eta
     */
    // costruttore, getters e setters generati
    public function __construct(string $nome, int $eta)
    {
        $this->nome = $nome;
        $this->eta = $eta;
    }

    public function get_nome(): string
    {
        return $this->nome;
    }

    public function set_nome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function get_eta(): int
    {
        return $this->eta;
    }

    public function set_eta(int $eta): void
    {
        $this->eta = $eta;
    }

    public function saluta(): void
    {
        echo "ciao, sono $this->nome";
    }

    public static function presentazione(): void // funzione statica = funzione NON di istanza, propria della classe
    {
        echo "ciao sono uno studente";
        echo " " . self::$num++;
    }
}

$s = new Studente("Diego", 18);
$s->saluta();

echo "<br>";
Studente::presentazione();
echo "<br>";
Studente::presentazione();
echo "<br>";
Studente::presentazione();
echo "<br>";
Studente::presentazione();
echo "<br>";
Studente::presentazione();