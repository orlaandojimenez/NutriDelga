@echo off
echo #############################################################
echo #############################################################
echo ## Generacion de documentacion para GRAYAP - Yii Framework ##
echo #############################################################
echo #############################################################
echo.
echo.

set OUT_DIR=/documentation
TITLE=Generacion de documentacion
:: generate API docs
vendor/bin/apidoc api . .%OUT_DIR% --pageTitle="GRAYAP Doc"
:: generate the guide (order is important to allow the guide to link to the apidoc)
vendor/bin/apidoc guide . .%OUT_DIR% --pageTitle="GRAYAP Doc"