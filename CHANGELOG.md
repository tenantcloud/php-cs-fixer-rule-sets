## [3.4.1](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v3.4.0...v3.4.1) (2025-02-11)


### Bug Fixes

* Allow GRAPHQL heredoc ([#36](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/36)) ([eb126a3](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/eb126a3b2c671982e1fe11345772e73482a81c9a))

# [3.4.0](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v3.3.1...v3.4.0) (2024-05-14)


### Features

* Support new PHP ([#35](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/35)) ([9cacccb](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/9cacccbb2ff3f64e3faba63a957d34821f5edd9b))

## [3.3.1](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v3.3.0...v3.3.1) (2024-05-14)


### Bug Fixes

* Don't change REGEXP heredoc marker to default one ([#31](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/31)) ([53d57b2](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/53d57b25a85aa06c5b96d495dc63fcc68cd7e247))

# [3.3.0](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v3.2.0...v3.3.0) (2024-05-13)


### Bug Fixes

* Release not triggered ([#28](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/28)) ([04d1a57](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/04d1a57846d9b662a529adbc2e8b39e6120640a4))
* Run release on GH runners ([#30](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/30)) ([72ec928](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/72ec928825b3235b3772dc255e1b159ad2d6b983))
* Run release outside container ([#29](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/29)) ([8aa1968](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/8aa1968c7d19f17ee1c079fba7c4b1ab990aef5c))


### Features

* New rules ([#27](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/27)) ([24b4399](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/24b43990e34ea19fa8abbe32aa4ee52a78d865a5))

# [3.2.0](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v3.1.0...v3.2.0) (2024-04-25)


### Features

* Template sync ([#24](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/24)) ([841838b](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/841838b1d16d20f76245ba3c40faa2fe6a775901)), closes [#23](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/23)

# [3.0.0](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v2.1.0...v3.0.0) (2023-06-27)


### Features

* New rules ([#21](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/21)) ([cf8666a](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/cf8666a9bfba5737f5c4c85f51ddb5c0e3894313))


### BREAKING CHANGES

* Changes to .php-cs-fixer.php are necessary

* fix: Missing tests directory

# [2.1.0](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v2.0.2...v2.1.0) (2023-06-23)


### Features

* Add new rules / change existing ([#20](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/20)) ([5a34ca8](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/5a34ca81b4703d802e9195a4a10ed409035cc7c0))

## [2.0.2](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v2.0.1...v2.0.2) (2023-06-20)


### Bug Fixes

* Allow any 3.x version of php-cs-fixer with rule sets ([#17](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/17)) ([c0d4478](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/c0d447814e99d0444880c8a7db6d066ecc8fb1b1))
* Failing release job ([#18](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/18)) ([4395baf](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/4395baf24c7679d9879f07d6ce777d8995a6b5de))
* Fix release ([#19](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/19)) ([5729266](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/572926655e6bf08ac99c54115943d14f79bd1ec3))

## [2.0.1](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v2.0.0...v2.0.1) (2022-12-08)


### Bug Fixes

* Avoid conversion of PHPDoc with [@var](https://github.com/var) or [@use](https://github.com/use); avoid dropping unused lambda imports due to reflection ([#16](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/16)) ([8e4a44a](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/8e4a44a6948e9cd00abef53638da20d9613581da))

# [2.0.0](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v1.4.0...v2.0.0) (2022-08-08)


### Bug Fixes

* Only run release when tests are successful ([#15](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/15)) ([7054c03](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/7054c03cb6b701c6d6a3d93de5a2c2f900bbaccf))


### Code Refactoring

* Allow usage of php-cs-fixer/shim ([#14](https://github.com/tenantcloud/php-cs-fixer-rule-sets/issues/14)) ([0d89bde](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/0d89bdec580533053ae4207a061134b8eb2be206))


### BREAKING CHANGES

* Change of structure. TenantCloudSet is no longer a php-cs-fixer rule set.

* docs: Texts

* build: Always release for now

* chore(release): 2.0.0-alpha.1 [skip ci]

# [2.0.0-alpha.1](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v1.4.0...v2.0.0-alpha.1) (2022-08-08)

### Code Refactoring

* Allow usage of php-cs-fixer/shim ([b7d3528](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/b7d3528c1b91463381e5fb23effd73deb951fecb))

### BREAKING CHANGES

* Change of structure. TenantCloudSet is no longer a php-cs-fixer rule set.

Co-authored-by: semantic-release-bot <semantic-release-bot@martynus.net>

# [2.0.0-alpha.1](https://github.com/tenantcloud/php-cs-fixer-rule-sets/compare/v1.4.0...v2.0.0-alpha.1) (2022-08-08)


### Code Refactoring

* Allow usage of php-cs-fixer/shim ([b7d3528](https://github.com/tenantcloud/php-cs-fixer-rule-sets/commit/b7d3528c1b91463381e5fb23effd73deb951fecb))


### BREAKING CHANGES

* Change of structure. TenantCloudSet is no longer a php-cs-fixer rule set.
