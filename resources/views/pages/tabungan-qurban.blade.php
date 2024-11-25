@extends('layouts.master')

@section('title', 'Tabungan Qurban')

@section('content')


<!-- Image Container -->
<div style="width: 98%; margin: 20px auto; background-color: #fff; border-radius: 20px; overflow: hidden;">
    <img src="{{ asset('sb-admin-2/img/login/taqur.png') }}" alt="Transaction Image" style="width: 100%; height: auto; object-fit: cover; border-radius: 20px;">
</div>


<!-- Qurban Savings Table -->
<div style="width: 98%; margin: 20px auto; background-color: #fff; border-radius: 20px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); overflow: hidden;">
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background-image: linear-gradient(to right, #B60A00, #EC5252);">
        <h2 style="color: #fff; font-size: 1.5rem; margin: 0;">Tabungan Qurban</h2>
        <div class="filter-form">
            <form action="{{ route('tabungan-qurban') }}" method="GET">
                <select name="bulan" id="bulan" style="border-radius: 10px;" onchange="this.form.submit()">
                    <option value="" style="color: #535353;">Select Month</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                        </option>
                    @endfor
                </select>
            </form>
        </div>
    </div>

    <!-- Table Container -->
    <div style="max-height: 210px; overflow-y: auto;">
        <table id="qurbanTable" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: linear-gradient(to bottom, #003366, #005ca8); color: white;">
                    <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Date</th>
                    <th style="padding: 8px; text-align: center; font-size: 0.9rem; border-bottom: 2px solid #fff; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($qurbanSavings as $qurban)
                    <tr style="background-color: #fff; text-align: center; cursor: pointer;"
                        onclick="showQurbanDetails('{{ $qurban['tanggal'] }}', 'Rp {{ number_format($qurban['nominal'], 0, ',', '.') }}')">
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $qurban['tanggal'] }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">Rp {{ number_format($qurban['nominal'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Modal for Qurban Savings Details -->
<div class="modal fade" id="qurbanDetailModal" tabindex="-1" aria-labelledby="qurbanDetailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
            <div class="modal-header" style="background-color: #005ca8; color: white;">
                <h5 class="modal-title" id="qurbanDetailLabel">Qurban Savings Details</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Date:</strong> <span id="modal-tanggal"></span></p>
                <p><strong>Nominal:</strong> <span id="modal-nominal"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showQurbanDetails(tanggal, nominal) {
        document.getElementById('modal-tanggal').innerText = tanggal;
        document.getElementById('modal-nominal').innerText = nominal;

        var modal = new bootstrap.Modal(document.getElementById('qurbanDetailModal'));
        modal.show();
    }
</script>

@endsection
