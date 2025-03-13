#!/usr/bin/env bash

HEADER=$'/**\n * Generated stub declarations for Timber.\n *  @see https://github.com/mccomaschris/timber-stubs\n */'

FILE="timber-stubs.php"

set -e

test -f "$FILE"
test -d "source/vendor/timber/timber/src"

# Exclude globals.
"$(dirname "$0")/vendor/bin/generate-stubs" \
    --include-inaccessible-class-nodes \
    --force \
    --finder=finder.php \
    --header="$HEADER" \
    --functions \
    --classes \
    --interfaces \
    --traits \
    --out="$FILE"
