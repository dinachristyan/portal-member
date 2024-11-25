@extends('layouts.master')

@section('title', 'Transaksi')

@section('content')

<!-- Image Container -->
<div style="width: 98%; margin: 20px auto; background-color: #fff; border-radius: 20px; overflow: hidden;">
    <img src="{{ asset('sb-admin-2/img/login/trans.png') }}" alt="Transaction Image" style="width: 100%; height: auto; object-fit: cover; border-radius: 20px;">
</div>

<!-- Transaction Table -->
<div style="width: 98%; margin: 20px auto; background-color: #fff; border-radius: 20px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); overflow: hidden;">
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 15px; background-image: linear-gradient(to right, #063153, #0D6DB9);">
        <h2 style="color: #fff; font-size: 1.5rem; margin: 0;">Transaksi</h2>
        <div class="filter-form">
            <form action="{{ route('transaksi') }}" method="GET">
                <select name="bulan" id="bulan" style="border-radius: 10px;" onchange="this.form.submit()">
                    <option value="" style="color: #535353;">Select Monthly</option>
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
        <table id="transactionTable" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: linear-gradient(to bottom, #003366, #005ca8); color: white;">
                    <th style="padding: 8px; text-align: center; font-size: 0.9rem; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Date</th>
                    <th style="padding: 8px; text-align: center; font-size: 0.9rem; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Label</th>
                    <th style="padding: 8px; text-align: center; font-size: 0.9rem; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">PoS Order</th>
                    <th style="padding: 8px; text-align: center; font-size: 0.9rem; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Payment Method</th>
                    <th style="padding: 8px; text-align: center; font-size: 0.9rem; position: sticky; top: 0; z-index: 10; background-color: #e0e0e0; color: grey;">Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $transaction)
                    <tr style="background-color: #fff; text-align: center; cursor: pointer;"
                        onclick="showTransaksiDetails('{{ $transaction['payment_date'] ?? '-' }}', '{{ $transaction['label'] ?? '-' }}', '{{ $transaction['pos_order_id'] ?? '-' }}', '{{ $transaction['payment_method'] ?? '-' }}', 'Rp {{ number_format($transaction['amount'] ?? 0, 0, ',', '.') }}')">
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transaction['payment_date'] ?? '-' }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transaction['label'] ?? '-' }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transaction['pos_order_id'] ?? '-' }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $transaction['payment_method'] ?? '-' }}</td>
                        <td style="padding: 10px; border: 1px solid #ddd;">Rp {{ number_format($transaction['amount'] ?? 0, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 10px; text-align: center; color: #888;">Tidak ada transaksi pada bulan ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModalTransaksi" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
            <div class="modal-header" style="background-color: #005ca8; color: white;">
                <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close" style="background: white;"></button>
            </div>
            <div class="modal-body">
                <p><strong>Date:</strong> <span id="modal-tanggal"></span></p>
                <p><strong>Label:</strong> <span id="modal-label"></span></p>
                <p><strong>PoS Order:</strong> <span id="modal-pos-order"></span></p>
                <p><strong>Payment Method:</strong> <span id="modal-metode-pembayaran"></span></p>
                <p><strong>Amount:</strong> <span id="modal-jumlah"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showTransaksiDetails(tanggal, label, posOrder, metodePembayaran, jumlah) {
        document.getElementById('modal-tanggal').innerText = tanggal;
        document.getElementById('modal-label').innerText = label;
        document.getElementById('modal-pos-order').innerText = posOrder;
        document.getElementById('modal-metode-pembayaran').innerText = metodePembayaran;
        document.getElementById('modal-jumlah').innerText = jumlah;

        var modal = new bootstrap.Modal(document.getElementById('detailModalTransaksi'));
        modal.show();
    }
</script>



@endsection
