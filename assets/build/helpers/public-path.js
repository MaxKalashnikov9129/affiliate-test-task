/* eslint-env browser */
/* globals BEETROOT_DIST_PATH */

/** Dynamically set absolute public path from current protocol and host */
if (BEETROOT_DIST_PATH) {
  __webpack_public_path__ = BEETROOT_DIST_PATH; // eslint-disable-line no-undef, camelcase
}
