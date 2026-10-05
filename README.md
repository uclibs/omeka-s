# UC Libraries Omeka S Git and Deployment Workflow

This document describes the working Git and server workflow for the UC
Libraries Omeka S installation.

## Current baseline

As of October 5, 2026:

-   **Omeka S production version:** 4.2.1
-   **GitHub `production` branch:** approved production code
-   **GitHub `qa` branch:** integration/staging branch; normally
    synchronized with `production` after a release
-   **GitHub default branch:** `qa`
-   **Production server:** `libapps2`
-   **Production application:** `/var/www/omekas`
-   **Test server:** `libappstest`
-   **Test application:** `/var/www/omekas`

The `qa` branch begins from the known-good production baseline. It may
move ahead of `production` while approved changes are undergoing final
integration and testing.

The server-specific database configuration is **not stored in Git**. In
particular, `config/database.ini` must remain specific to each server.

------------------------------------------------------------------------

## Branch roles

### `production`

`production` represents the code that is approved for and running in
production.

Treat this as the **known-good baseline**. Do not use `production` for
experiments.

### `qa`

`qa` is the final integration/staging branch.

Normally, after a production release, `qa` and `production` should point
to the same known-good code. As new work is approved for integration,
`qa` may move ahead of `production` until the next production release.

New experimental work should not be performed directly on `qa` when it
can be isolated in a feature branch.

### Feature/test branches

Create a separate branch for each module update, new module, Omeka
upgrade, or other significant change.

Examples:

-   `update-blockplus`
-   `test-new-module`
-   `update-css-editor`
-   `omeka-4-3-upgrade`

A feature branch should normally begin from the current `qa` branch,
provided `qa` contains the intended baseline.

This keeps experimental work identifiable and prevents an unfinished
test from becoming an unexplained difference between test and
production.

### `main`

The existing `main` branch is **not currently part of this deployment
workflow**.

Do not assume that UC's `main` branch is the equivalent of the `master`
branch mentioned in upstream Omeka documentation. The upstream
documentation describes the Omeka project's own branch/release
conventions; UC's repository has its own history and deployment
workflow.

Do not reorganize or repurpose `main` without first reviewing its
history and deciding explicitly what role it should have.

------------------------------------------------------------------------

## Normal workflow for a new change

The normal path is:

    production (known good)
          |
          v
         qa
          |
          v
    feature/test branch
          |
          v
      libappstest
          |
       testing
          |
          v
         qa
          |
    final validation
          |
          v
      production

### 1. Start with a clean QA baseline

Before beginning new work, verify that `qa` contains the intended
baseline.

After a completed production release, `qa` will normally match
`production`.

### 2. Create a feature branch

For example:

    git switch qa
    git pull origin qa
    git switch -c update-blockplus

Use a descriptive branch name so that it is obvious why the test server
differs from production.

### 3. Make the change on the feature branch

Install or update the module, theme, Omeka code, or other files required
for the test.

Commit those changes to the feature branch.

Do **not** commit server-specific database credentials or runtime data.

### 4. Deploy the feature branch to `libappstest`

Use `libappstest` to test the feature branch.

It is normal for the test server to differ from production **while an
identified feature branch is being tested**.

The important rule is that the difference must be represented in Git,
rather than existing only as unexplained files on the test server.

### 5. Test the change

Verify both the specific change and the rest of the Omeka site.

For a module change, check at least:

-   Omeka admin loads normally.
-   Public sites load normally.
-   The module installs/activates without errors.
-   Existing pages using the module still work.
-   Any required module dependencies are documented.
-   No unexpected database migration or configuration change occurred.

### 6. Merge the successful feature into `qa`

When the feature works on `libappstest`, merge it into `qa`, preferably
through a GitHub pull request when practical.

Then perform a final QA check using the integrated `qa` branch.

### 7. Promote QA to production

When QA is approved, merge/promote `qa` into `production`.

Production should receive only changes that have already been tested.

Do not force-push `production` as part of the normal workflow.

### 8. Return to a clean baseline

After a successful production deployment, bring `qa` back into
synchronization with `production` if necessary.

At that point:

    qa == production

The next experiment begins on a new feature branch.

Old feature branches can be deleted after they are no longer needed and
their changes are safely represented in `qa`/`production`.

------------------------------------------------------------------------

## Server-specific files: preserve these

The production and test servers use different databases.

**Never overwrite one server's `config/database.ini` with the other
server's copy.**

At minimum, preserve and verify:

    config/database.ini
    config/local.config.php

`config/database.ini` is intentionally excluded from Git.

Before a deployment that replaces application files, back up the target
server's configuration and verify it afterward.

### Production

Production must retain the production database configuration on:

    libapps2:/var/www/omekas/config/database.ini

### Test

Test must retain the test database configuration on:

    libappstest:/var/www/omekas/config/database.ini

The application code can match while the database configuration remains
different.

------------------------------------------------------------------------

## Modules and test-server experiments

Do not install or update a module only on `libappstest` and leave the
change undocumented.

That creates filesystem drift: months later it becomes unclear whether
the difference was intentional, approved, abandoned, or required.

Instead:

1.  Create a named feature branch.
2.  Put the module change in that branch.
3.  Deploy that branch to `libappstest`.
4.  Test it.
5.  Merge it to `qa` only if approved.
6.  Promote it to `production` only after QA succeeds.

If an experiment fails, discard the feature branch and restore
`libappstest` to the clean `qa` baseline.

`libappstest` should normally reflect the code being tested from an
identified Git branch. Any intentional difference from the production
module baseline should therefore be represented by that branch and its
commits.

------------------------------------------------------------------------

## Example: testing a Block Plus update

Assume production and QA contain Block Plus 3.4.20 and a newer release
needs testing.

Create a branch:

    git switch qa
    git pull origin qa
    git switch -c update-blockplus

Update Block Plus and any genuinely required dependencies on that
branch.

Deploy `update-blockplus` to `libappstest`.

If the test fails:

    discard/revert the experiment
    restore libappstest from qa

If the test succeeds:

    update-blockplus -> qa -> final QA -> production

This prevents a newer Block Plus installation or its dependencies from
remaining on the test server without a corresponding Git history
explaining why it is there.

------------------------------------------------------------------------

## Omeka upgrades

An Omeka core upgrade should also be treated as a feature/release change
rather than performed first on `production`.

A future upgrade can use a branch such as:

    omeka-4-3-upgrade

Test the upgrade on `libappstest`, including modules and themes. Once
verified, merge it into `qa`, perform final QA, and then promote it to
`production`.

If using an Omeka released ZIP rather than a Git pull, remember that
replacing the application directory can remove `.git`. The deployment
procedure must therefore deliberately preserve the Git workflow rather
than assuming the deployed application directory remains a Git checkout.

------------------------------------------------------------------------

## Important Git safety rules

-   `production` is the known-good release branch.
-   `qa` is the integration/final-test branch.
-   Experiments belong in named feature branches.
-   Do not use `main` merely because upstream documentation mentions
    `master`.
-   Do not commit `config/database.ini`.
-   Do not commit uploaded/runtime `files/` or logs merely to make
    servers look identical.
-   Do not force-push `production` during normal development.
-   Use `--force-with-lease` only for an intentional branch-history
    correction and only after verifying why it is necessary.
-   Before a destructive deployment, preserve the target server's
    environment-specific configuration.
-   A test-server difference should always have an identifiable reason
    in Git.

------------------------------------------------------------------------

## Current known module baseline

At the October 5, 2026 production baseline:

-   Block Plus: **3.4.20**
-   Common: **not present**
-   ActivityLog: **1.0.1**
-   SingleSignOn: **3.4.12**
-   Verovio: **3.3.0.7**

`libappstest` should normally reflect the code being tested from an
identified Git branch. Any intentional module difference from production
should be represented by that branch and its commits.

------------------------------------------------------------------------

## In short

For everyday work, remember:

    FEATURE BRANCH -> LIBAPPSTEST -> QA -> PRODUCTION

And after a release:

    QA == PRODUCTION

That gives UC Libraries a clean production baseline, a controlled QA
stage, and a safe place to experiment without losing track of what
changed or why.
