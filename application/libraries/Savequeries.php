<?php
/**
 * Classe armazena todas as queries executadas no sistema
 */
class Savequeries{
    private $CI;

    function __construct()
    {
    }
    private $fileName = "application/queries/storedQueries.txt";
    public function getFileName() {
        return $this->fileName;
    }
    
    /**
     * Escreve as queries passadas em um arquivo
     * @param type $string
     */
    public function write($string){
        $fileContent = $this->getFileContent();
        $file = fopen($this->getFileName(), "w") or die("Unable to open file!");
        if($file){
            fwrite($file, $fileContent . "\n".$string . ";");
        }else{
            //echo "não foi";
        }
        fclose($file);
    }
    /**
     * Retorna o conteúdo do arquivo
     * @return String
     */
    public function getFileContent() {
        $handle = fopen($this->getFileName(), "r");
        $content = fread($handle, 9999);
        fclose($handle);
        return $content;
    }
    
    /**
     * Limpa o arquivo
     */
    public function clearFile() {
        $file = fopen($this->getFileName(), "w") or die("Unable to open file!");
        if($file){
            fwrite($file, " \n");
        }
    }
}