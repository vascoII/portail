export function OccupantCGUContent() {
  return (
    <div className="prose prose-sm max-w-none">
      <h3>Conditions d'Utilisation - Occupant</h3>

      <ol>
        <li>
          <strong>Objet</strong>
          <p>
            La société TECHEM met à votre disposition un accès à votre compte
            personnel sur le site
            <a
              href="https://client.techem.fr"
              target="_blank"
              rel="noopener noreferrer"
            >
              {" "}
              client.techem.fr
            </a>
            , vous permettant de suivre vos consommations d'eau.
          </p>
        </li>

        <li>
          <strong>Accès à votre Compte Personnel</strong>
          <p>
            Seules les personnes titulaires d'un bail et ayant reçu de leur
            bailleur un identifiant et un mot de passe peuvent utiliser un
            Compte Personnel.
          </p>
          <p>
            Par sécurité, nous vous conseillons de modifier votre mot de passe
            lors de votre première connexion.
          </p>
        </li>

        <li>
          <strong>Les services proposés</strong>
          <p>
            En accédant à votre Espace Personnel, vous pourrez notamment
            consulter les consommations d'eau ou de chauffage de votre logement.
          </p>
        </li>

        <li>
          <strong>Données à caractère personnel</strong>
          <p>
            Les informations collectées sont traitées dans le strict respect du
            RGPD. Vous disposez d'un droit d'accès et de rectification des
            données vous concernant.
          </p>
          <p>
            Pour exercer ces droits, contactez :
            <a href="mailto:data@techem.fr">data@techem.fr</a>
          </p>
        </li>

        <li>
          <strong>Loi applicable</strong>
          <p>
            Les présentes Conditions d'Utilisation sont soumises à la loi
            française.
          </p>
        </li>
      </ol>
    </div>
  );
}
