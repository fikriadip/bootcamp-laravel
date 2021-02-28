<?php

namespace App\Http\Livewire;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Location;

class MapLocation extends Component
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    use WithFileUploads;

    public $locationId,$long,$lat,$title,$description,$image;
    public $geoJson;
    public $imageUrl;
    public $isEdit = false; // ketika kita mengclick si location tadi kita bakal ngubah ke mode idEdit
    // public $test = "value test";

    private function loadLocations(){
        $locations = Location::orderBy('created_at', 'desc')->get();

        $customLocations = []; // menampung perulangan

        foreach ($locations as $location) {
            $customLocations[] = [
                'type' => 'Feature',
                'geometry' => [
                    'coordinates' => [$location->long, $location->lat],
                    'type' => 'Point'
                ],
                'properties' => [
                    'locationId' => $location->id,
                    'title' => $location->title,
                    'image' => $location->image,
                    'description' => $location->description
                ] 
            ];
        }

        $geoLocation = [
            'type' => 'FeatureCollection',
            'features' => $customLocations
        ];

        $geoJson = collect($geoLocation)->toJson();
        $this->geoJson = $geoJson; // Di conversi menjadi data json

    }

    // meClear data form ketika di submit
    private function clearForm(){
        $this->long = '';
        $this->lat = '';
        $this->title = '';
        $this->description = '';
        $this->image = '';
    }

    public function saveLocation()
    {
        // melakukan sebuah validasi pada form
        $this->validate([
            'long' => 'required',
            'lat' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|max:3048|required', // tidak bisa memasukkan gambar lebih dari 3mb
        ]);

        // menghasilkan nama yang unik pada setiap file image di database pada column image
        $imageName = md5($this->image.microtime()).'.'.$this->image->extension();

        Storage::putFileAs(           
            'public/images', // yang pertama dari dia di simpan
            $this->image, // dari mana sumber nya
            $imageName // dan apa nama file nya
        );

        // di dapat dari public $ yang sudah di tentukan dan yang sudah di banding ke sisi front end dengan wire:model
        Location::create([
            'long' => $this->long,
            'lat' => $this->lat,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imageName,
        ]);
        
        session()->flash('success', 'Map Was Successfully Added');
        $this->clearForm();
        $this->loadLocations();
        // ketika loadLocations data geoJson terupdate dan kita kirim
        $this->dispatchBrowserEvent('locationAdded', $this->geoJson);

    }


    public function findLocationById($id)
    {
        $location = Location::findOrFail($id); // menampung id location yang di dapat ketika click marker
        
        // menampilkan data ke form ketika salah satu marker di klik
        $this->locationId = $id; // didapat dari variable yang ada di atas
        $this->long = $location->long; // didapat dari variable yang ada di atas
        $this->lat = $location->lat; // didapat dari variable yang ada di atas
        $this->title = $location->title; // didapat dari variable yang ada di atas
        $this->description = $location->description; // didapat dari variable yang ada di atas
        $this->imageUrl = $location->image; // didapat dari variable yang ada di atas
        $this->isEdit = true; // untuk memberi tahu bahwa kita sedang mengedit
    }

    public function updateLocation()
    {
        // memberi validasi pada form edit
        $this->validate([
            'long' => 'required',
            'lat' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $location = Location::findOrFail($this->locationId); // di tampung sementara oleh variable sebelum di eksekusi

        // jika kita update gambar maka akan masuk ke bagian if
        if ($this->image) {
            $imageName = md5($this->image.microtime()).'.'.$this->image->extension();

            Storage::putFileAs(           
                'public/images', // yang pertama dari dia di simpan
                $this->image, // dari mana sumber nya
                $imageName // dan apa nama file nya
            );

            $updateData = [
                'title' => $this->title,
                'description' => $this->description,
                'image' => $imageName
            ];

        // jika kita tidak update gambar maka akan masuk ke bagian else yang hanya mengedit title dan deskripsi 
        } else {
            $updateData = [
                'title' => $this->title,
                'description' => $this->description,
            ];
        }

        // didapat dari $location yang ada di atas
        $location->update($updateData); // updateData yang ada di condisional if dan else
        $this->imageUrl = ""; // Clear image sesudah di update

        
        $this->clearForm();
        $this->isEdit = false; // Sesudah  UpdateLocation makan akan muncul button Submmit Location
        $this->loadLocations();
        // ketika loadLocations data geoJson terupdate dan kita kirim
        $this->dispatchBrowserEvent('updateLocation', $this->geoJson);        
    }
    
    public function deleteLocation(){
        $location = Location::findOrFail($this->locationId);
        $location->delete();
        session()->flash('danger', 'Delete Map Successfully');

        $this->imageUrl = "";
        $this->clearForm();
        $this->isEdit = false; // ketika delete Location makan akan muncul button Submmit Location
        // ketika loadLocations data geoJson terupdate dan kita kirim
        $this->dispatchBrowserEvent('deleteLocation', $location->id);
    }

    // render function loadLocations agar data bisa bertambah 
    public function render()
    {
        $this->loadLocations();
        return view('livewire.map-location'); // mereturn ke halaman map-location
    }
}
