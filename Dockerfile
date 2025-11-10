# syntax=docker/dockerfile:1
FROM php:8.2-apache

# Copy application source into the Apache document root
COPY GDS_GIFI_V1/ /var/www/html/

# Set recommended PHP.ini settings and enable Apache modules if needed
# (no extra modules required for current app)

# Expose the default Apache port
EXPOSE 80

# The base image already defines the default command to run Apache in the foreground
