@extends('layouts.app')

@section('style')
<style>
        /* Pour s’assurer que la liste suggestions se superpose bien */
        .suggestions-list {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000; /* Pour que la liste passe au-dessus d'autres éléments */
        }

        .suggestions-list li {
            padding: .5rem .75rem;
            cursor: pointer;
        }

        .suggestions-list li:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<form action="{{route('client.store')}}" method="POST">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nouveau Client</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                @csrf
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Enregistrer</button>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="company" class="form-label">Nom de Société</label>
                        <input type="text" class="form-control" id="company" name="company">
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="last_name" name="last_name">
                    </div>
                    <div class="mb-3">
                        <label for="address1" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="address1" name="address1">
                        <ul class="list-unstyled suggestions-list mt-1 d-none" id="suggestions-list"></ul>
                    </div>
                    <div class="mb-3">
                        <label for="address2" class="form-label">Adresse complément</label>
                        <input type="text" class="form-control" id="address2" name="address2">
                    </div>
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">Code postal</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="mb-3">
                        <label for="phone1" class="form-label">Téléhpone 1</label>
                        <input type="text" class="form-control" id="phone1" name="phone1">
                    </div>
                    <div class="mb-3">
                        <label for="phone2" class="form-label">Téléhpone 2</label>
                        <input type="text" class="form-control" id="phone2" name="phone2">
                    </div>
                    <div class="mb-3">
                        <label for="phone3" class="form-label">Téléhpone 1</label>
                        <input type="text" class="form-control" id="phone3" name="phone3">
                    </div>
                    <div class="mb-3">
                        <label for="siret" class="form-label">Numéro de SIRET</label>
                        <input type="text" class="form-control" id="siret" name="siret">
                    </div>
                    <div class="mb-3">
                        <label for="tva_number" class="form-label">Numéro de TVA</label>
                        <input type="text" class="form-control" id="tva_number" name="tva_number">
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Commentaire</label>
                        <textarea class="form-control" name="comment" id="comment" cols="30" rows="10"></textarea>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('address1');
    const suggestionsList = document.getElementById('suggestions-list');
    const cityInput = document.getElementById('city');
    const postcodeInput = document.getElementById('zip_code');
    let debounceTimer;

    input.addEventListener('input', () => {
        const query = input.value.trim();
        
        if (query.length < 3) {
            suggestionsList.innerHTML = '';
            suggestionsList.classList.add('d-none');
            return;
        }

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            fetchSuggestions(query);
        }, 300);
    });

    function fetchSuggestions(query) {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&limit=5&countrycodes=fr&q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                displaySuggestions(data);
            })
            .catch(err => {
                console.error(err);
            });
    }

    function displaySuggestions(data) {
        suggestionsList.innerHTML = '';

        if (data.length === 0) {
            suggestionsList.classList.add('d-none');
            return;
        }

        data.forEach(item => {
            const li = document.createElement('li');
            const address = item.address || {};
            const city = address.city || address.town || address.village || '';
            const postcode = address.postcode || '';
            let address_display = item.address.house_number+' '+item.address.road+' '+postcode+' '+city;
            console.log(item)
            // li.textContent = item.display_name;
            li.textContent = address_display;
            li.addEventListener('click', () => {
                // input.value = item.display_name;
                input.value = item.address.house_number+' '+item.address.road;
                suggestionsList.innerHTML = '';
                suggestionsList.classList.add('d-none');

                // Remplir les champs dédiés
                cityInput.value = city;
                postcodeInput.value = postcode;
            });
            suggestionsList.appendChild(li);
        });

        suggestionsList.classList.remove('d-none');
    }

    document.addEventListener('click', (event) => {
        if (!event.target.closest('.position-relative')) {
            suggestionsList.innerHTML = '';
            suggestionsList.classList.add('d-none');
        }
    });
});
</script>
@endsection
