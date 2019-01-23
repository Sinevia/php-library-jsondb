<?php

namespace Sinevia;

class JsonDb {
    public $data = [];
    public $filePath = null;
    
    public function __construct($filePath, $autoOpen = false) {
        $this->filePath = $filePath;
        if($autoOpen == true){
            $this->open();
        }
    }
    
    /**
     * Deletes this database
     */
    public function delete() {
        return unlink($this->filePath);
    }
    
    /**
     * Checks if database exsts
     */
    public function exists() {
        return file_exists($this->filePath);
    }
    
    /**
     * Gets a key from database
     */
    public function get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
    
    /**
     * Gets a key from database
     */
    public function has($key) {
        return isset($this->data[$key]) ? true : false;
    }

    
    /**
     * Saves the data to the file
     */
    public function save() {
        return file_put_contents($this->filePath, json_encode($this->data));
    }
    
    /**
     * Opens the database and reads data in
     */
    public function open() {
        if ($this->exists() == false) {
            $this->save();
        }
        $this->data = json_decode(file_get_contents($this->filePath), true);
    }
    
    /**
     * Removes a key from database
     */
    public function remove($key) {
        unset($this->data[$key]);
    }
    
    /**
     * Sets new key value pair
     */
    public function set($key, $value) {
        $this->data[$key] = $value;
    }
}
?>
