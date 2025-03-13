<?php
class Animal {
    public $animals;

    public function __construct($ar_animal)
    {
        $this->animals = $ar_animal;
    }
    public function index ()
    {
        foreach ($this->animals as $animal){
        echo "- $animal <br/>";
    }
    }

    public function store ($animal){
        $this->animals[] = $animal;
    }
    public function update ($index, $animal){
        $this->animals[$index] = $animal;
    }
    public function destroy ($index){
        unset($this->animals[$index]);
    }
}
// membuat object
// kirimkan data array ke dalam constructor
$animal = new Animal(["Ayam", "Bebek", "Ikan"]);

echo "index - Menampilkan seluruh hewan <br/>";
$animal->index();
echo "<br/>";

// method store
echo "store - Menambahkan hewan baru (kucing, anjing, babi) <br/>";
$animal->store("Kucing");
$animal->store("Anjing");
$animal->store("Babi");
$animal->index();
echo "<br/>";

// method update
echo "update -  Mengupdate hewan  hewan baru <br/>";
$animal->update(0, "Kucing Anggora");
$animal->update(4, "Anjing cihua hua");
$animal->index();
echo "<br/>";

// method destroy
echo "destroy -  Mengupdate hewan  hewan baru <br/>";
$animal->destroy(2);
$animal->destroy(5);
$animal->destroy(3);
$animal->index();
echo "<br/>";