#!/bin/bash

find /tmp -cmin +30 -name "cache*" -delete
