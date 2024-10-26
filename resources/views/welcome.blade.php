<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      Couturart - L'application révolutionnaire pour les couturiers et stylistes
      au Burkina Faso
    </title>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="{{asset('assets/images/icon.jpeg')}}" alt="Couturart Logo" class="logo" />
          Couturart
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#features">Fonctionnalités</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#preview">Aperçu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#pricing">Tarifs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#testimonials">Témoignages</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#download">Télécharger</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="hero">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h1>Révolutionnez votre atelier de couture</h1>
            <p class="lead">
              Couturart : L'application 100% Burkinabè qui simplifie la gestion
              de votre activité
            </p>
            <a href="#" class="btn btn-primary btn-lg mt-3"
              >Essai gratuit d'1 mois</a
            >
          </div>
          <div class="col-lg-6">
            <img
              src="https://placeholderimage.eu/api/600/400"
              alt="Couturart App Preview"
              class="img-fluid rounded-3 shadow-lg"
            />
          </div>
        </div>
      </div>
    </header>

    <section id="features" class="features">
      <div class="container">
        <h2 class="text-center mb-5">Fonctionnalités clés</h2>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="feature-card">
              <i class="fas fa-bolt feature-icon"></i>
              <h3>Gain de temps considérable</h3>
              <p>
                Fini les cahiers et les calculs manuels ! Gérez vos clients et
                commandes 3 fois plus rapidement qu'avec les méthodes
                traditionnelles.
              </p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="feature-card">
              <i class="fas fa-cloud feature-icon"></i>
              <h3>Données sécurisées</h3>
              <p>
                Vos données sont sauvegardées automatiquement dans le cloud.
                Plus de risque de perte même si votre téléphone tombe en panne !
              </p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="feature-card">
              <i class="fas fa-money-bill-wave feature-icon"></i>
              <h3>Meilleur suivi financier</h3>
              <p>
                Suivez facilement vos revenus, dépenses et bénéfices. Identifiez
                vos modèles les plus rentables en un coup d'œil.
              </p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="feature-card">
              <i class="fas fa-mobile-alt feature-icon"></i>
              <h3>Travaillez hors connexion</h3>
              <p>
                L'application fonctionne même sans internet ! Vos données se
                synchronisent automatiquement dès que vous retrouvez une
                connexion.
              </p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="feature-card">
              <i class="fas fa-users feature-icon"></i>
              <h3>Fidélisez vos clients</h3>
              <p>
                Gardez un historique détaillé de chaque client et de leurs
                préférences. Informez-les automatiquement quand leur commande
                est prête !
              </p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="feature-card">
              <i class="fas fa-star feature-icon"></i>
              <h3>Service client local</h3>
              <p>
                Une équipe 100% Burkinabè à votre écoute pour vous accompagner
                et vous former à l'utilisation de l'application.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="preview" class="preview">
      <div class="container">
        <h2 class="text-center mb-5">Aperçu de l'application</h2>
        <div class="row g-4">
          <div class="col-md-4">
            <img
              src="https://placeholderimage.eu/api/400/600"
              alt="Écran de gestion des mesures"
              class="img-fluid rounded-3 shadow"
            />
            <p class="text-center mt-3">Écran de gestion des mesures</p>
          </div>
          <div class="col-md-4">
            <img
              src="https://placeholderimage.eu/api/400/600"
              alt="Tableau de bord des commandes"
              class="img-fluid rounded-3 shadow"
            />
            <p class="text-center mt-3">Tableau de bord des commandes</p>
          </div>
          <div class="col-md-4">
            <img
              src="https://placeholderimage.eu/api/400/600"
              alt="Statistiques de l'atelier"
              class="img-fluid rounded-3 shadow"
            />
            <p class="text-center mt-3">Statistiques de l'atelier</p>
          </div>
        </div>
      </div>
    </section>

    <section id="pricing" class="pricing">
      <div class="container">
        <h2 class="text-center mb-5">Choisissez votre formule</h2>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="pricing-card">
              <h3>Basic</h3>
              <div class="pricing-options">
                <div class="monthly">
                  <p class="price">2 000 FCFA<span>/mois</span></p>
                  <small>ou</small>
                  <p class="annual-price text-success">
                    19 000 FCFA<span>/an</span>
                  </p>
                  <div class="savings-badge">Économisez 5 000 FCFA</div>
                </div>
              </div>
              <p class="text-muted mb-4">Pour les ateliers débutants</p>
              <ul class="feature-list">
                <li><i class="fas fa-check"></i> Jusqu'à 100 clients</li>
                <li>
                  <i class="fas fa-check"></i> Gestion des mesures clients
                </li>
                <li>
                  <i class="fas fa-check"></i> Suivi des commandes de base
                </li>
                <li>
                  <i class="fas fa-check"></i> Statistiques mensuelles simples
                </li>
                <li><i class="fas fa-check"></i> Sauvegarde des données</li>
                <li><i class="fas fa-check"></i> Mode hors connexion</li>
                <li><i class="fas fa-check"></i> Support par WhatsApp</li>
                <li class="text-muted">
                  <i class="fas fa-times"></i> Export des données
                </li>
              </ul>
              <p class="text-success mb-4">✨ Premier mois gratuit !</p>
              <a href="#" class="btn btn-outline-danger btn-lg"
                >Commencer gratuitement</a
              >
            </div>
          </div>

          <div class="col-md-4">
            <div class="pricing-card featured">
              <div class="popular-badge">Plus populaire</div>
              <h3>Premium</h3>
              <div class="pricing-options">
                <div class="monthly">
                  <p class="price">3 500 FCFA<span>/mois</span></p>
                  <small>ou</small>
                  <p class="annual-price text-success">
                    30 000 FCFA<span>/an</span>
                  </p>
                  <div class="savings-badge">Économisez 12 000 FCFA</div>
                </div>
              </div>
              <p class="text-muted mb-4">Pour les ateliers en croissance</p>
              <ul class="feature-list">
                <li><i class="fas fa-check"></i> Clients illimités</li>
                <li>
                  <i class="fas fa-check"></i> Toutes les fonctionnalités Basic
                </li>
                <li><i class="fas fa-check"></i> Export PDF et Excel</li>
                <li><i class="fas fa-check"></i> Statistiques détaillées</li>
                <li><i class="fas fa-check"></i> Galerie photos illimitée</li>
                <li><i class="fas fa-check"></i> Notifications SMS clients</li>
                <li><i class="fas fa-check"></i> Support prioritaire 7j/7</li>
                <li><i class="fas fa-check"></i> 2h de formation incluse</li>
              </ul>
              <p class="text-success mb-4">🎁 3 mois au prix de 2</p>
              <a href="#" class="btn btn-primary btn-lg">Choisir Premium</a>
            </div>
          </div>

          <div class="col-md-4">
            <div class="pricing-card">
              <h3>VIP</h3>
              <div class="pricing-options">
                <div class="monthly">
                  <p class="price">7 000 FCFA<span>/mois</span></p>
                  <small>ou</small>
                  <p class="annual-price text-success">
                    60 000 FCFA<span>/an</span>
                  </p>
                  <div class="savings-badge">Économisez 24 000 FCFA</div>
                </div>
              </div>
              <p class="text-muted mb-4">Pour les grands ateliers</p>
              <ul class="feature-list">
                <li>
                  <i class="fas fa-check"></i> Toutes les fonctionnalités
                  Premium
                </li>
                <li><i class="fas fa-check"></i> Support dédié 24/7</li>
                <li><i class="fas fa-check"></i> Formation sur site (4h)</li>
                <li>
                  <i class="fas fa-check"></i> Personnalisation de l'interface
                </li>
                <li><i class="fas fa-check"></i> Gestion multi-utilisateurs</li>
                <li><i class="fas fa-check"></i> Rapports personnalisés</li>
                <li><i class="fas fa-check"></i> Backup quotidien</li>
                <li><i class="fas fa-check"></i> Page web boutique incluse</li>
              </ul>
              <p class="text-success mb-4">🎁 6 mois au prix de 4</p>
              <a href="#" class="btn btn-outline-danger btn-lg">Devenir VIP</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="testimonials" class="testimonials">
      <div class="container">
        <h2 class="text-center mb-5">Ce que disent nos clients</h2>
        <div class="row">
          <div class="col-md-4">
            <div class="testimonial-card">
              <img
                src="https://placeholderimage.eu/api/80/80"
                alt="Aminata K."
                class="rounded-circle"
              />
              <p>
                "Couturart a complètement transformé la gestion de mon atelier.
                Je gagne un temps précieux chaque jour."
              </p>
              <h4>Aminata K.</h4>
              <p class="text-muted">Styliste à Ouagadougou</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="testimonial-card">
              <img
                src="https://placeholderimage.eu/api/80/80"
                alt="Issouf T."
                class="rounded-circle"
              />
              <p>
                "Mes clients sont ravis de recevoir des notifications sur
                l'avancement de leurs commandes. C'est un vrai plus pour mon
                activité."
              </p>
              <h4>Issouf T.</h4>
              <p class="text-muted">Tailleur à Bobo-Dioulasso</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="testimonial-card">
              <img
                src="https://placeholderimage.eu/api/80/80"
                alt="Fatou S."
                class="rounded-circle"
              />
              <p>
                "Les statistiques m'aident à mieux comprendre mon activité et à
                prendre les bonnes décisions pour développer mon atelier."
              </p>
              <h4>Fatou S.</h4>
              <p class="text-muted">Créatrice de mode à Koudougou</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="download" class="cta">
      <div class="container text-center">
        <h2 class="mb-4">Téléchargez Couturart maintenant</h2>
        <p class="lead">Disponible sur Android, iOS, Web et PC</p>
        <div class="mt-4">
          <a href="#" class="btn btn-light btn-lg me-3 mb-3"
            ><i class="fab fa-google-play me-2"></i>Google Play</a
          >
          <a href="#" class="btn btn-light btn-lg me-3 mb-3"
            ><i class="fab fa-apple me-2"></i>App Store</a
          >
          <a href="#" class="btn btn-light btn-lg mb-3"
            ><i class="fas fa-globe me-2"></i>Version Web</a
          >
        </div>
      </div>
    </section>

    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h5>À propos de Couturart</h5>
            <p>
              Couturart est la solution 100% Burkinabè pour les professionnels
              de la couture et de la mode.
            </p>
          </div>
          <div class="col-md-4">
            <h5>Liens rapides</h5>
            <ul class="list-unstyled">
              <li><a href="#features">Fonctionnalités</a></li>
              <li><a href="#preview">Aperçu</a></li>
              <li><a href="#pricing">Tarifs</a></li>
              <li><a href="#testimonials">Témoignages</a></li>
              <li><a href="#download">Télécharger</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5>Contactez-nous</h5>
            <p>Email: contact@couturart.com<br />Tél: +226 XX XX XX XX</p>
            <div class="social-icons mt-3">
              <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
              <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
              <a href="#" class="me-2"><i class="fab fa-tiktok"></i></a>
              <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>
        <hr />
        <div class="text-center mt-3">
          <p>&copy; 2024 Couturart - Tous droits réservés</p>
        </div>
      </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
