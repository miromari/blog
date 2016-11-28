google-spreadsheet-api
======================

Implementation of the Google Spreadsheet API 3.0

[![Build Status](https://travis-ci.org/MikeRoetgers/google-spreadsheet-api.png?branch=master)](https://travis-ci.org/MikeRoetgers/google-spreadsheet-api)

## Status

This is still a WIP. Keep in mind that everything can change until 1.0.0 is reached. Currently only reading data is implemented.

## Authorization

The lib is only tested with the OAuth 2.0 authorization method.

It is your responsibility to make sure the access token is valid. The client does not refresh the token automatically.