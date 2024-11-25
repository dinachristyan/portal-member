@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<div class="container-member container">
    <div class="header">
        <img src="{{ asset('img/login/kanitraputih.png') }}" alt="Logo" class="logo">
        <h2>Membership Info</h2>
    </div>
    <div class="content mb-4">
        <div class="member-info">
            <div class="identity">
                <div class="row justify-content-center">
                    <h3 class="anggota">IDENTITAS ANGGOTA</h3>
                </div>
                <table>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td>{{ $profile['nama_anggota'] ?? '' }}</td>
                        <td>Credit Limit</td>
                        <td>:</td>
                        <td>1,000,000</td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>{{ $profile['nik'] ?? '' }}</td>
                        <td>Credit Balance</td>
                        <td>:</td>
                        <td>800,000</td>
                    </tr>
                    <tr>
                        <td>Perusahaan</td>
                        <td>:</td>
                        <td>{{ $profile['company_id'] ?? '' }}</td>
                        <td>Membership Status</td>
                        <td>:</td>
                        <td>
                            @php
                                $status = 'active'
                            @endphp
                            @if($status === 'active')
                                <span class="status active" style="border-radius: 25px">Active</span>
                            @else
                                <span class="status inactive" style="border-radius: 25px">Inactive</span>
                            @endif
                        </td>
                        {{-- <td>
                            @php
                                $status = $profile['status'] ?? 'inactive'; // Menetapkan nilai default 'inactive'
                            @endphp
                            @if($status === 'active')
                                <span class="status active" style="border-radius: 25px">Active</span>
                            @else
                                <span class="status inactive" style="border-radius: 25px">Inactive</span>
                            @endif
                        </td> --}}
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $profile['email'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Anggota</td>
                        <td>:</td>
                        <td>KAN901700011000</td>
                    </tr>
                    <tr>
                        <td>Tanggal Bergabung</td>
                        <td>:</td>
                        <td>{{ $profile['tgl_member'] ?? '' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <hr class="divider">

        <div class="personal-info">
            <div class="row justify-content-center">
                <h3>INFO PRIBADI</h3>
            </div>
            <table>
                <tr>
                    <td>Nomor Telepon</td>
                    <td>:</td>
                    <td>{{ $profile['telephone'] ?? '' }}</td>
                    <td>Nama Suami/Istri</td>
                    <td>:</td>
                    <td>Salsabilla Putri</td> <!-- Example Data -->
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $profile['email'] ?? '' }}</td>
                    <td>No Telepon Darurat</td>
                    <td>:</td>
                    <td>081234567890</td> <!-- Example Data -->
                </tr>
                <tr>
                    <td>NPWP</td>
                    <td>:</td>
                    <td>1234567</td> <!-- Example Data -->
                    <td>Alamat</td>
                    <td>:</td>
                    <td>Jalan Example No. 1</td> <!-- Example Data -->
                </tr>
            </table>
        </div>
        
        <div class="text-center mt-3">
            @if($status === 'active')
                <button type="button" class="edit-button" id="openUpdateModalButton">Update Profile</button>
            @else
                <span class="text-danger">Profile tidak dapat diupdate karena status tidak aktif.</span>
            @endif
        </div>
    </div>

    
<!-- Update Profile Modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 10px; background-color: #f9f9f9; padding: 20px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
            <div class="modal-header" style="background-color: #4a90e2; color: white; border-top-left-radius: 10px; border-top-right-radius: 10px; padding: 15px;">
                <h5 class="modal-title" id="updateProfileModalLabel" style="font-weight: bold;">Update Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white; font-size: 1.2rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 20px 10px; background-color: #f7f8fc;">
                <form id="updateProfileForm">
                    @csrf
                    <div class="form-group">
                        <label for="modal-telephone" style="font-weight: 500; color: #333;">Telephone</label>
                        <input type="text" class="form-control" id="modal-telephone" name="telephone" value="{{ $profile['telephone'] ?? '' }}" style="border-radius: 8px; padding: 10px; border: 1px solid #ddd; transition: border-color 0.3s ease;">
                    </div>
                    <div class="form-group">
                        <label for="modal-email" style="font-weight: 500; color: #333;">Email</label>
                        <input type="email" class="form-control" id="modal-email" name="email" value="{{ $profile['email'] ?? '' }}" style="border-radius: 8px; padding: 10px; border: 1px solid #ddd; transition: border-color 0.3s ease;">
                    </div>
                    <div class="form-group">
                        <label for="modal-emergency-contact" style="font-weight: 500; color: #333;">Emergency Contact</label>
                        <input type="text" class="form-control" id="modal-emergency-contact" name="emergency_contact" placeholder="Enter emergency contact number" style="border-radius: 8px; padding: 10px; border: 1px solid #ddd; transition: border-color 0.3s ease;">
                    </div>
                    <div class="form-group">
                        <label for="modal-npwp" style="font-weight: 500; color: #333;">NPWP</label>
                        <input type="text" class="form-control" id="modal-npwp" name="npwp" placeholder="Enter NPWP" style="border-radius: 8px; padding: 10px; border: 1px solid #ddd; transition: border-color 0.3s ease;">
                    </div>
                    <div class="form-group">
                        <label for="modal-address" style="font-weight: 500; color: #333;">Address</label>
                        <input type="text" class="form-control" id="modal-address" name="address" placeholder="Enter your address" style="border-radius: 8px; padding: 10px; border: 1px solid #ddd; transition: border-color 0.3s ease;">
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #ddd; padding-top: 15px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #e0e0e0; color: #333; border-radius: 6px; padding: 8px 16px; transition: background-color 0.3s ease;">Close</button>
                <button type="button" class="btn btn-primary" id="submitUpdateProfile" style="background-color: #4a90e2; color: white; border-radius: 6px; padding: 8px 16px; transition: background-color 0.3s ease;">Update</button>
            </div>
        </div>
    </div>
</div>
</div>

<style>

table {
    width: 100%;
    border-collapse: collapse;
    color: #00264d; /* Warna teks tabel */
}

td {
    padding: 10px 20px; /* Tambah padding untuk spasi yang lebih baik */
    vertical-align: top;
    font-weight: 700; /* Berat font tebal */
    border-bottom: 1px solid #ddd; /* Tambah garis bawah antar baris untuk pemisahan yang lebih jelas */
}

/* Tambahan untuk header tabel, jika ada */
th {
    padding: 10px 20px; /* Padding untuk header tabel */
    background-color: #f8f8f8; /* Warna latar belakang untuk header tabel */
    font-weight: bold;
}

.identity, .personal-info {
    width: 100%; /* Pastikan identitas dan info pribadi memanfaatkan lebar penuh */
}

.identity h3, .personal-info h3 {
    color: #00264d; /* Warna judul */
    font-size: 14px; /* Ukuran font judul */
    font-weight: bold;
    margin: 20px 0 10px; /* Margin untuk jarak atas dan bawah judul */
    text-align: left; /* Rata kiri untuk judul */
}

    .container-member {
        max-width: 900px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 25px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        background: linear-gradient(to bottom, #00264d, #004080);
        color: white;
        border-radius: 25px 25px 0 0;
        width: 100%;
        box-sizing: border-box;
        position: absolute;
        top: 0;
        left: 0;
    }

    .header h2 {
        margin-right: 20px;
        font-weight: 700; /* Bold font weight */
        font-size: 24px;
    }

    .logo {
        width: 150px;
    }

    .content {
        margin-top: 80px;
    }

    .member-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .photo img {
        border-radius: 10px;
        width: 120px;
        height: 150px;
        object-fit: cover;
        margin-top: 30px;
    }

    .identity, .personal-info {
        width: calc(100% - 140px);
    }

    .identity h3, .personal-info h3 {
        color: white; /* Dark blue color */
        font-size: 13px;
        font-weight: 700; /* Bold font weight */
        margin: 0;
        padding: 10px;
        background: linear-gradient(135deg, #ff7e5f, #feb47b);
        border-radius: 20px;
        text-align: center;
        display: inline-block;
        justify-content: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        color: #00264d; /* Dark blue color for table text */
    }

    td {
        padding: 5px 10px;
        vertical-align: top;
        font-weight: 700; /* Bold font weight */
    }

    .status {
        font-weight: 700; /* Bold font weight */
        padding: 2px 6px;
        border-radius: 5px;
        color: #fff;
    }

    .status.active {
        background-color: #00b34b;
    }

    .status.inactive {
        background-color: #d9534f;
    }

    .personal-info table {
        margin-top: 10px;
    }

    .edit-button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 700;
        color: #fff;
        background: #004080;
        border: none;
        border-radius: 25px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
        margin: 10px 0;
        text-transform: uppercase;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .edit-button:hover {
        background-color: #003366;
        transform: translateY(-2px);
    }

    .edit-button:focus {
        outline: none;
    }

    /* Remove default button styles for the <button> element */
    button {
        all: unset;
        cursor: pointer;
    }
</style>

<script>
    document.getElementById('openUpdateModalButton').addEventListener('click', function() {
        $('#updateProfileModal').modal('show');
    });

    document.getElementById('submitUpdateProfile').addEventListener('click', function() {
        // Gather form data
        const formData = {
            telephone: document.getElementById('modal-telephone').value,
            email: document.getElementById('modal-email').value,
            emergency_contact: document.getElementById('modal-emergency-contact').value,
            npwp: document.getElementById('modal-npwp').value,
            address: document.getElementById('modal-address').value,
        };

        // Get the CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        const token = csrfToken ? csrfToken.getAttribute('content') : '';

        // Send the request to Laravel's internal update route
        fetch('/profile/update', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);

                // Update the main profile display fields if they exist
                const telephoneField = document.getElementById('telephone');
                const emailField = document.getElementById('email');

                if (telephoneField) {
                    telephoneField.value = formData.telephone;
                }

                if (emailField) {
                    emailField.value = formData.email;
                }

                // Hide the modal
                $('#updateProfileModal').modal('hide');
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>

@endsection
