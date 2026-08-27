# EZ-ITIN deployment status

## Architecture

- GitHub repository: `ezstartup01/ez-itin-wordpress`
- Stable branch: `main`
- Development/deployment branch: `staging`
- Deployment target: existing SiteGround staging installation at `staging2.ez-itin.com`
- Production `ez-itin.com` is intentionally excluded from the workflow.

## Managed scope

Only intentionally managed custom code belongs in this repository:

```text
wp-content/
  themes/
    ez-itin-block-theme/
```

WordPress core, uploads, caches, backups, logs, database dumps, credentials, private keys, and environment files are excluded.

## Workflow

`.github/workflows/deploy-stagging2.yml` runs only on pushes to `staging`. It validates the exact staging target before using SSH and rsync. It does not delete unrelated server files and does not deploy to production.

## Current status

- Current staging custom theme synchronized locally from the deployed staging theme.
- SiteGround SSH deployment key created as `ezitin-cli`; private material is stored only as an encrypted GitHub Actions secret.
- Repository secrets configured for the SiteGround connection and exact staging path.
- SSH key and configured passphrase were replaced with a matching pair after the initial deployment-key validation failure.
- Documentation-only staging commit triggered the safe deployment and post-deployment WP-CLI verification test on August 27, 2026.
