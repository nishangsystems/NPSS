<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use mysqli;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".gz";
  
        $hostname = env('DB_HOST');
        $username = env('DB_USERNAME'); // Sostituisci con il tuo nome utente
        $password = env('DB_PASSWORD'); // Sostituisci con la tua password
        $database = env('DB_DATABASE'); // Sostituisci con il nome del tuo database

        $backupDir = storage_path('app/db_backup'); // Modifica il percorso in base a dove desideri salvare il backup

        // Connessione al database
        $mysqli = new mysqli($hostname, $username, $password, $database);

        // Verifica la connessione
        if ($mysqli->connect_error) {
            die("Connessione al database fallita: " . $mysqli->connect_error);
        }

        // Ottieni il nome di tutte le tabelle nel database
        $tables = [];
        $result = $mysqli->query("SHOW TABLES");
        while ($row = $result->fetch_row()) {
            $tables[] = $row[0];
        }

        // Esegui l'esportazione completa in un unico file
        $backupFileName = $backupDir . '/backup_' . date('Y-m-d_H-i-s') . '.sql';
        $fileContent = '';

        foreach ($tables as $table) {
            $query = "SELECT * FROM $table";
            $result = $mysqli->query($query);
            
            $fileContent .= "-- Inizio dati della tabella: $table\n";
            while ($row = $result->fetch_assoc()) {
                $fileContent .= "INSERT INTO $table VALUES (";
                foreach ($row as $value) {
                    $fileContent .= "'" . $mysqli->real_escape_string($value) . "', ";
                }
                $fileContent = rtrim($fileContent, ', ');
                $fileContent .= ");\n";
            }
            $fileContent .= "-- Fine dati della tabella: $table\n\n";
        }

        // Scrivi il contenuto nel file di backup
        if (file_put_contents($backupFileName, $fileContent) !== false) {
            echo "Backup completato con successo: $backupFileName";
        } else {
            echo "Impossibile creare il file di backup.";
        }

        $mysqli->close();
    }
}
