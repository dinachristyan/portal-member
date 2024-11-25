@extends('layouts.master')

@section('title', 'Dashboard Test')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Acara</h1>
    </div>

    <!-- Card layout -->
    <div class="row">

<!-- Card Slider Layout -->
<div class="col-12 mb-4" style="position: relative;">
    <div class="card shadow" style="border-radius: 15px; overflow: hidden; height: 400px;">
        <div class="slider-container" style="position: relative; height: 100%;">
            <div class="slider" style="display: flex; transition: transform 0.5s ease-in-out; height: 100%;">

                <!-- Slide 1 -->
                <div class="slide active" style="min-width: 100%; display: flex; height: 100%; position: relative;">
                    <div>
                        <img src="{{ asset('sb-admin-2/img/login/slide1.png') }}" alt="Kanitra New Merchandise" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="flex: 1; padding: 20px; display: flex; flex-direction: column; justify-content: center;">
                        <h2 style="color: #063153;">KANITRA NEW MERCHANDISE</h2>
                        <p>
                            Kopkar Kanitra mempersembahkan koleksi merchandise terbaru yang hadir khusus untuk Sobat Kanitra semua!
                            Koleksi merchandise terbaru ini bisa Sobat Kanitra dapatkan segera.
                        </p>
                        <button onclick="window.location.href='/news1'" 
                        style="position: absolute; right: 20px; bottom: 20px; padding: 10px 20px; background-color: #063153; border: none; color: #fff; cursor: pointer; border-radius: 5px;">
                            Read More
                        </button>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="slide" style="min-width: 100%; display: flex; height: 100%; position: relative;">
                    <div>
                        <img src="{{ asset('sb-admin-2/img/login/slide2.png') }}" alt="Merchandise 2" 
                             style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="flex: 1; padding: 20px; display: flex; flex-direction: column; justify-content: center;">
                        <h2 style="color: #063153;">KANITRA MERCH COLLECTION</h2>
                        <p>
                            Temukan koleksi baru dari Kanitra, mulai dari payung, bantal leher, kipas portable, hingga clutch kulit.
                        </p>
                        <button onclick="window.location.href='/news2'" 
                        style="position: absolute; right: 20px; bottom: 20px; padding: 10px 20px; background-color: #063153; border: none; color: #fff; cursor: pointer; border-radius: 5px;">
                            Read More
                        </button>
                    </div>
                </div>
            </div>

            <!-- Navigasi -->
            <button class="prev" style="position: absolute; top: 50%; left: 10px; transform: translateY(-50%); background-color: rgba(0, 0, 0, 0.5); color: #fff; border: none; cursor: pointer; padding: 10px; border-radius: 50%;">&#10094;</button>
            <button class="next" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background-color: rgba(0, 0, 0, 0.5); color: #fff; border: none; cursor: pointer; padding: 10px; border-radius: 50%;">&#10095;</button>
        </div>
    </div>

    <!-- Dots Indicator (Dipindahkan lebih ke bawah) -->
    <div style="text-align: center; margin-top: 20px; position: relative;">
        <span class="dot active" style="display: inline-block; width: 12px; height: 12px; margin: 0 5px; background-color: #007BFF; border-radius: 50%; cursor: pointer;"></span>
        <span class="dot" style="display: inline-block; width: 12px; height: 12px; margin: 0 5px; background-color: #bbb; border-radius: 50%; cursor: pointer;"></span>
    </div>
</div>

<!-- JavaScript -->
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    function showSlide(index) {
        if (index >= slides.length) {
            currentSlide = 0;
        } else if (index < 0) {
            currentSlide = slides.length - 1;
        } else {
            currentSlide = index;
        }

        const slider = document.querySelector('.slider');
        slider.style.transform = `translateX(-${currentSlide * 100}%)`;

        dots.forEach((dot, i) => {
            dot.style.backgroundColor = (i === currentSlide) ? '#007BFF' : '#bbb';
        });
    }

    document.querySelector('.next').addEventListener('click', () => {
        showSlide(currentSlide + 1);
    });

    document.querySelector('.prev').addEventListener('click', () => {
        showSlide(currentSlide - 1);
    });

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            showSlide(i);
        });
    });

    showSlide(currentSlide);
</script>

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Info Anggota</h1>
        </div>
    
        <!-- Card layout -->
        <div class="row">

        <!-- Transaction Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('transaksi') }}" style="text-decoration: none;">
                <div class="card shadow h-100 py-2" style="background: linear-gradient(45deg, #001f3f, #007bff); border-radius: 15px; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                    <div class="card-body" style="cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <div class="d-flex align-items-center mb-2" style="justify-content: center;">
                            <img src="{{ asset('sb-admin-2/img/login/transaksi.png') }}" alt="Transaksi Icon" class="img-fluid" style="width: 40px; height: 40px; filter: brightness(0) invert(1); margin-right: 8px;" /> <!-- Ukuran ikon diperbesar -->
                            <div class="text-xs font-weight-bold text-light text-uppercase" style="font-size: 1.2rem;">
                                Transaksi
                            </div>
                        </div>
                        <hr style="border: 0.5px solid rgba(255, 255, 255, 0.5); margin: 0.5rem 0; width: 100%;"> <!-- Memperluas garis horizontal -->
                        <div class="h5 mb-0 font-weight-bold text-white text-center">
                            Rp {{ number_format($transactionTotal, 0, ',', '.') }}                            
                        </div>
                    </div>
                </div>
            </a>
        </div>


                <!-- Pinjaman Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('pinjaman') }}" style="text-decoration: none;">
                <div class="card shadow h-100 py-2" style="background: linear-gradient(45deg, #ff7f00, #ff4500); border-radius: 15px; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                    <div class="card-body" style="cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <div class="d-flex align-items-center mb-2" style="justify-content: center;">
                            <img src="{{ asset('sb-admin-2/img/login/pinjaman.png') }}" alt="Pinjaman Icon"
                                    style="height: 40px; width: 40px; margin-right: 8px; filter: brightness(0) invert(1);"> <!-- Ukuran ikon diperbesar -->
                            <div class="text-xs font-weight-bold text-light text-uppercase" style="font-size: 1.2rem;">
                                PINJAMAN
                            </div>
                        </div>
                        <hr style="border: 0.5px solid rgba(255, 255, 255, 0.5); margin: 0.5rem 0; width: 100%;"> <!-- Memperluas garis horizontal -->
                        <div class="h5 mb-0 font-weight-bold text-white text-center">
                            Rp {{ number_format($loanTotal, 0, ',', '.') }}                            
                        </div>
                    </div>
                </div>
            </a>
        </div>

    
        <!-- Simpanan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('simpanan') }}" style="text-decoration: none;">
                <div class="card shadow h-100 py-2" style="background: linear-gradient(45deg, #28a745, #20c997); border-radius: 15px; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                    <div class="card-body" style="cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <div class="d-flex align-items-center mb-2" style="justify-content: center;">
                            <img src="{{ asset('sb-admin-2/img/login/simpanan.png') }}" alt="Simpanan Icon" 
                                    style="height: 40px; width: 40px; margin-right: 8px; filter: brightness(0) invert(1);"> <!-- Ukuran ikon diperbesar -->
                            <div class="text-xs font-weight-bold text-light text-uppercase" style="font-size: 1.2rem;">
                                Simpanan
                            </div>
                        </div>
                        <hr style="border: 0.5px solid rgba(255, 255, 255, 0.5); margin: 0.5rem 0; width: 100%;"> <!-- Memperluas garis horizontal -->
                        <div class="h5 mb-0 font-weight-bold text-white text-center">
                            Rp {{ number_format($savingTotal, 0, ',', '.') }}                            
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- Tabungan Qurban Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ url('tabungan-qurban') }}" style="text-decoration: none;">
                <div class="card shadow h-100 py-2" style="background: linear-gradient(45deg, #dc3545, #ff6b6b);  border-radius: 15px; transition: transform 0.2s ease, box-shadow 0.2s ease;">
                    <div class="card-body" style="cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <div class="d-flex align-items-center mb-2" style="justify-content: center;">
                            <img src="{{ asset('sb-admin-2/img/login/tabungan.png') }}" alt="Tabungan Icon"
                                style="height: 40px; width: 40px; margin-right: 8px; filter: brightness(0) invert(1);"> <!-- Ukuran ikon diperbesar -->
                            <div class="text-xs font-weight-bold text-light text-uppercase" style="font-size: 1.2rem;">
                                Tabungan Qurban
                            </div>
                        </div>
                        <hr style="border: 0.5px solid rgba(255, 255, 255, 0.5); margin: 0.5rem 0; width: 100%;"> <!-- Memperluas garis horizontal -->
                        <div class="h5 mb-0 font-weight-bold text-white text-center">
                            Rp {{ number_format($qurbanTotal, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- Transaction Table -->
        <div style="width: 98%; margin: 20px auto; background-color: #fff; border-radius: 20px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); overflow: hidden;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background-image: linear-gradient(to right, #003366, #005ca8);">
                <h2 style="color: #fff; font-size: 1.5rem; margin: 0;">Transaction Details</h2>
            </div>
        
            <div style="max-height: 210px; overflow-y: auto;">
                <table id="transactionTable" style="width: 100%; border-collapse: collapse;">
                    <thead style="background-color: #e0e0e0;">
                        <tr style="background: linear-gradient(to bottom, #003366, #005ca8); color: white;">
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Date</th>
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Label</th>
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">PoS Order</th>
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Payment Method</th>
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr style="background-color: #fff; text-align: center;">
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $transaction['payment_date'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $transaction['label'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $transaction['pos_order_id'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $transaction['payment_method'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Rp {{ number_format($transaction['amount'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Saving Table -->
        <div style="width: 98%; margin: 20px auto; background-color: #fff; border-radius: 20px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); overflow: hidden;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background-image: linear-gradient(to right, #003366, #005ca8);">
                <h2 style="color: #fff; font-size: 1.5rem; margin: 0;">Saving Details</h2>
            </div>
        
            <div style="max-height: 210px; overflow-y: auto;">
                <table id="savingTable" style="width: 100%; border-collapse: collapse;">
                    <thead style="background-color: #e0e0e0;">
                        <tr style="background: linear-gradient(to bottom, #003366, #005ca8); color: white;">
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Date</th>
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Type</th>
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($savings as $saving)
                        <tr style="background-color: #fff; text-align: center;">
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $saving['date'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $saving['jenis_tagihan'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Rp {{ number_format($saving['amount'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Loan Table -->
        <div style="width: 98%; margin: 20px auto; background-color: #fff; border-radius: 20px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); overflow: hidden;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background-image: linear-gradient(to right, #003366, #005ca8);">
                <h2 style="color: #fff; font-size: 1.5rem; margin: 0;">Loan Details</h2>
            </div>

            <div style="max-height: 210px; overflow-y: auto;">
                <table id="loanTable" style="width: 100%; border-collapse: collapse;">
                    <thead style="background-color: #e0e0e0;">
                        <tr style="background: linear-gradient(to bottom, #003366, #005ca8); color: white;">
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Date</th>
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Type</th>
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                        <tr style="background-color: #fff; text-align: center;">
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $loan['date'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $loan['jenis_tagihan'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Rp {{ number_format($loan['amount'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        
        <!-- Qurban Savings Table -->
        <div style="width: 98%; margin: 20px auto; background-color: #fff; border-radius: 20px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); overflow: hidden;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background-image: linear-gradient(to right, #003366, #005ca8);">
                <h2 style="color: #fff; font-size: 1.5rem; margin: 0;">Qurban Savings Details</h2>
            </div>
        
            <div style="max-height: 210px; overflow-y: auto;">
                <table id="qurbanTable" style="width: 100%; border-collapse: collapse;">
                    <thead style="background-color: #e0e0e0;">
                        <tr style="background: linear-gradient(to bottom, #003366, #005ca8); color: white;">
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Date</th>
                            <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($qurbanSavings as $qurban)
                        <tr style="background-color: #fff; text-align: center;">
                            <td style="padding: 10px; border: 1px solid #ddd;">{{ $qurban['tanggal'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Rp {{ number_format($qurban['nominal'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            
@endsection

@section('scripts')
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#transactionTable').DataTable();
        $('#loanTable').DataTable();
        $('#savingTable').DataTable();
        $('#qurbanTable').DataTable();
    });
</script>
@endsection
