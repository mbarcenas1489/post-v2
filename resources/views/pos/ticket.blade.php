<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Venta #{{ $sale->id }}</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            line-height: 1.4;
            margin: 0;
            padding: 10px;
            background: white;
        }
        .ticket {
            width: 300px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 10px;
        }
        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .company-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .company-info {
            font-size: 10px;
            margin-bottom: 5px;
        }
        .sale-info {
            margin-bottom: 10px;
        }
        .sale-info div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }
        .items {
            border-top: 1px dashed #000;
            border-bottom: 1px dashed #000;
            padding: 10px 0;
            margin: 10px 0;
        }
        .item {
            margin-bottom: 5px;
        }
        .item-name {
            font-weight: bold;
        }
        .item-details {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            margin-left: 10px;
        }
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #000;
        }
        .payment {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #000;
        }
        .payment div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 10px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .ticket {
                border: none;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="ticket">
        <!-- Header -->
        <div class="header">
            <div class="company-name">POS SYSTEM</div>
            <div class="company-info">Sistema de Punto de Venta</div>
            <div class="company-info">Tel: (123) 456-7890</div>
            <div class="company-info">Email: info@possystem.com</div>
        </div>

        <!-- Sale Info -->
        <div class="sale-info">
            <div>
                <span>Ticket #:</span>
                <span>{{ $sale->id }}</span>
            </div>
            <div>
                <span>Fecha:</span>
                <span>{{ $sale->date->format('d/m/Y H:i') }}</span>
            </div>
            <div>
                <span>Cliente:</span>
                <span>{{ $sale->customer->name ?? 'Cliente General' }}</span>
            </div>
            <div>
                <span>Vendedor:</span>
                <span>{{ auth()->user()->name }}</span>
            </div>
        </div>

        <!-- Items -->
        <div class="items">
            <div style="font-weight: bold; margin-bottom: 5px;">PRODUCTOS:</div>
            @foreach($sale->items as $item)
                <div class="item">
                    <div class="item-name">{{ $item->product->name }}</div>
                    <div class="item-details">
                        <span>{{ $item->quantity }} x ${{ number_format($item->price, 2) }}</span>
                        <span>${{ number_format($item->subtotal, 2) }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Total -->
        <div class="total">
            TOTAL: ${{ number_format($sale->total, 2) }}
        </div>

        <!-- Payment -->
        <div class="payment">
            <div>
                <span>Método de Pago:</span>
                <span>EFECTIVO</span>
            </div>
            <div>
                <span>Efectivo Recibido:</span>
                <span>${{ number_format($sale->total, 2) }}</span>
            </div>
            <div>
                <span>Cambio:</span>
                <span>$0.00</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div>¡Gracias por su compra!</div>
            <div>Vuelva pronto</div>
            <div style="margin-top: 10px;">
                <div>--------------------------------</div>
                <div>Ticket generado el {{ now()->format('d/m/Y H:i:s') }}</div>
            </div>
        </div>
    </div>

    <script>
        // Auto-print when page loads
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>
