<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation des Souscriptions - Couturart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --accent-color: #3498db;
            --background-color: #f5f6fa;
        }

        body {
            background-color: var(--background-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: var(--primary-color);
            padding: 1rem 0;
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .main-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .page-title {
            color: var(--primary-color);
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid var(--accent-color);
        }

        .search-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.8rem;
            border: 2px solid #e1e1e1;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-search {
            background-color: var(--accent-color);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-search:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .results-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 1rem;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
        }

        .status-pending {
            background-color: #ffeaa7;
            color: #d35400;
        }

        .status-active {
            background-color: #55efc4;
            color: #00b894;
        }

        .status-cancelled {
            background-color: #fab1a0;
            color: #d63031;
        }

        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            margin: 0 0.2rem;
            font-weight: 600;
        }

        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-container {
                padding: 1rem;
                margin: 1rem;
            }

            .table-responsive {
                border-radius: 10px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-scissors me-2"></i>
                Couturart
            </a>
        </div>
    </nav>

    <div class="main-container">
        <h1 class="page-title">
            <i class="fas fa-search me-2"></i>
            Validation des Souscriptions
        </h1>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="search-card">
            <form action="{{ route('subscriptions.search.result') }}" method="POST">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-9">
                        <label for="matricule" class="form-label">
                            <i class="fas fa-id-card me-2"></i>
                            Matricule de l'atelier
                        </label>
                        <input type="text" name="matricule" id="matricule" class="form-control"
                               placeholder="Entrez le matricule de l'atelier" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-search w-100">
                            <i class="fas fa-search me-2"></i>
                            Rechercher
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if (isset($subscriptions))
            @if ($subscriptions->count())
                <div class="results-table">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Plan</th>
                                    <th>Durée</th>
                                    <th>Montant</th>
                                    <th>Paiement</th>
                                    <th>Téléphone</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $subscription)
                                    <tr>
                                        <td>#{{ $subscription->id }}</td>
                                        <td>
                                            <i class="fas fa-crown me-2"></i>
                                            {{ $subscription->plan }}
                                        </td>
                                        <td>
                                            <i class="fas fa-calendar me-2"></i>
                                            {{ $subscription->duration }}
                                        </td>
                                        <td>
                                            <i class="fas fa-money-bill me-2"></i>
                                            {{ number_format($subscription->amount, 0, ',', ' ') }} FCFA
                                        </td>
                                        <td>
                                            <i class="fas fa-credit-card me-2"></i>
                                            {{ $subscription->payment_method }}
                                        </td>
                                        <td>
                                            <i class="fas fa-phone me-2"></i>
                                            {{ $subscription->phone_number }}
                                        </td>
                                        <td>
                                            <span class="status-badge status-{{ strtolower($subscription->status) }}">
                                                {{ $subscription->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($subscription->status === 'pending')
                                                <form action="{{ route('subscriptions.activate', $subscription->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-action btn-success">
                                                        <i class="fas fa-check me-1"></i>
                                                        Activer
                                                    </button>
                                                </form>
                                                <form action="{{ route('subscriptions.cancel', $subscription->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-action btn-danger">
                                                        <i class="fas fa-times me-1"></i>
                                                        Annuler
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted">
                                                    <i class="fas fa-lock me-1"></i>
                                                    Action non disponible
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Aucun résultat trouvé pour ce matricule.
                </div>
            @endif
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
