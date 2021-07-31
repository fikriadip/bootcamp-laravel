<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    MapBox
                </div>
                <div class="card-body">
                    <div wire:ignore id='map' style='width: 100%; height: 73vh;'></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white text-center">
                    Data Form
                </div>
                <div class="card-body">
                    @if(session()->has('danger'))
                    <div class="bg-danger border-2 rounded-b mb-2 py-3 px-3">
                        <div>
                            <strong>{{ session('danger') }}</strong>
                        </div>
                    </div>
                    @endif

                    @if(session()->has('success'))
                    <div class="bg-success border-2 rounded-b mb-2 py-3 px-3">
                        <div>
                            <strong>{{ session('success') }}</strong>
                        </div>
                    </div>
                    @endif

                    {{-- jika if edit nya adalah true maka yang dijalankan adalah function updateLocation --}}
                    {{-- jika tidak lagi edit maka yang dijalankan adalah function saveLocation --}}
                    <form @if($isEdit) wire:submit.prevent="updateLocation" @else wire:submit.prevent="saveLocation"
                        @endif>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Longtitude</label>
                                    {{-- mengambil variable long dari livewire --}}
                                    <input wire:model="long" type="text" class="form-control" readonly>
                                    @error('long') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Lattitude</label>
                                    {{-- mengambil variable lat dari livewire --}}
                                    <input wire:model="lat" type="text" class="form-control" readonly>
                                    @error('lat') <small class="text-danger">{{$message}}</small>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input wire:model="title" type="text" class="form-control" id="title">
                            @error('title') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea wire:model="description" class="form-control" id="desc"></textarea>
                            @error('description') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        <div class="form-group">
                            <label for="pict">Picture</label>
                            <div class="custom-file mb-2">
                                <input wire:model="image" type="file" class="custom-file-input" id="pict">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                            @error('image') <small class="text-danger">{{$message}}</small>@enderror

                            {{-- menampilkan image dari livewire --}}
                            {{-- jadi ketika mengganti akan menampilkan yang preview --}}
                            @if ($image)
                            <img src="{{$image->temporaryUrl()}}" width="432%" class="img-fluid card border-dark">
                            @endif

                            {{-- ketika ingin mengedit dan melihat perubahan nya maka akan memanggil yang dibawah ini --}}
                            @if ($imageUrl && !$image) {{-- jika ada image dan tidak ada image --}}
                            <img src="{{ asset('/storage/images/'.$imageUrl)}}" width="432%"
                                class="img-fluid card border-dark">
                            {{-- mengambil dari image yang ada storage livewire  --}}
                            @endif
                        </div>
                        <div class="form-group">
                            {{-- menggunakan ternary untuk kondisi Update Location and Submit Location --}}
                            {{-- <button type="submit" class="btn btn-dark btn-block rounded-lg">{{$isEdit ? "Update Location" : "Submit Location"}}</button>
                            --}}
                            {{-- @if ($isEdit) --}}

                            <button wire:click="saveLocation" type="submit"
                                class="btn btn-dark btn-block rounded-lg">Submit Location</button>
                            {{-- @endif --}}

                            @if ($isEdit)

                            <button wire:click="updateLocation" type="submit"
                                class="btn btn-dark btn-block rounded-lg">Update Location</button>
                            @endif

                            @if ($isEdit)
                            {{-- muncul button delete dan button Create new data ketika sedang di halaman edit --}}
                            <button wire:click="deleteLocation" type="button"
                                class="btn btn-danger btn-block rounded-lg">Delete Location</button>
                            <a href="{{ url('/map') }}" class="btn btn-primary btn-block rounded-lg">Create New
                                Location</a>
                            @endif


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // meLoad livewire with addEventListener 
    document.addEventListener('livewire:load', () => {

        // mengarah ke titik koordinat yang sudah di tentukan
        const defaultLocation = [116.5935914783368, -2.871368264704799]

        mapboxgl.accessToken = '{{ env("MAPBOX_KEY")}}'; // menerima accesToken dari key yang ada di file .env
        var map = new mapboxgl.Map({
            container: 'map',
            center: defaultLocation, // mencenter location default dari longtitude dan lattitude
            zoom: 5.5, // zoom location yang sudah di tentukan
            // style: 'mapbox://styles/mapbox/streets-v11' // style map default
        });

        // looping array
        const loadLocations = (geoJson) => {
            geoJson.features.forEach((location) => {
                // nama nya object destructuring jadi bisa menested object pada javascript
                const {
                    geometry,
                    properties
                } = location
                const {
                    iconSize,
                    locationId,
                    title,
                    image,
                    description
                } = properties

                // style marker
                let markerElement = document.createElement('div')
                markerElement.className = 'marker' +
                    locationId // membuat className nya unik per marker
                markerElement.id = locationId
                markerElement.style.backgroundImage =
                    'url(https://www.mapbox.com/help/demos/custom-markers-gl-js/mapbox-icon.png)'
                markerElement.style.backgroundSize = 'cover'
                markerElement.style.width = '50px'
                markerElement.style.height = '50px'
                markerElement.style.cursor = 'pointer'
                markerElement.style.borderRadius = '360px'

                // menyimpan setiap file image kedalam storage/images yang berada di public
                const imageStorage = '{{asset("/storage/images")}}' + '/' + image

                // mencetak content yang berada di dalam marker
                const content = `
                <div style="overflow: auto; max-height: 650px; max-width:100%;">
                    <table class="mt-2">
                        <tbody>
                            <tr class="mb-2">
                                <td><h4>${title}</h4></td>
                            </tr>
                            <tr>
                                <td><img src="${imageStorage}" width="700%" loading="lazy" class="card border-dark img-fluid"></td>
                            </tr>
                            <tr>
                                <td>${description}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `

                markerElement.addEventListener('click', (
                e) => { // melakukan callback setiap kali di click
                    const locationId = e.toElement.id
                    @this.findLocationById(
                        locationId) // menggunakan inline script dari livewire
                });

                // memberikan PopUp pada setiap marker
                const popUp = new mapboxgl.Popup({
                    offset: 30
                }).setHTML(content).setMaxWidth("400px")

                new mapboxgl.Marker(markerElement)
                    .setLngLat(geometry.coordinates)
                    .setPopup(popUp)
                    .addTo(map)
            });
        }

        // Menampilkan data Json dari php
        loadLocations({
            !!$geoJson!!
        });

        // add Location
        window.addEventListener('locationAdded', (e) => {
            // data nya dalam bentuk object yang diambil dari livewire MapLocation yang berada di object e.detail
            loadLocations(JSON.parse(e.detail))
        });

        // Update Location
        window.addEventListener('updateLocation', (e) => {
            // data nya dalam bentuk object yang diambil dari livewire MapLocation yang berada di object e.detail
            loadLocations(JSON.parse(e.detail))
            // menghilangkan PopUp setelah update
            $('.mapboxgl-popup').remove() // jquery remove
            // console.log("update")
        });

        // Remove Location
        window.addEventListener('deleteLocation', (e) => {
            // delete marker sesuai id yang dikirim jadi ketika di delete marker nya akan hilang dari map
            $('.marker' + e.detail).remove() // jquery remove
            $('.mapboxgl-popup').remove() // jquery remove
        });

        // mencetak value dari livewire dengan console
        // console.log("ini value dari livewire", @this.test);

        // mesetting style map secara manual
        const style = "satellite-v9"
        // light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
        map.setStyle(`mapbox://styles/mapbox/${style}`)

        // memberi navigasi plus dan minus untuk zoom location
        map.addControl(new mapboxgl.NavigationControl());

        // jika click location maka akan mendapatkan titik koordinat longtitude dan lattitude
        map.on('click', (e) => {
            const longtitude = e.lngLat.lng
            const lattitude = e.lngLat.lat

            @this.long = longtitude
            @this.lat = lattitude

            // mencetak titik koordinat dengan console
            //  console.log({longtitude, lattitude});  
        });
    });
</script>
@endpush