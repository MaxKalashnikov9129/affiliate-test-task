/* eslint-env browser */
/* globals cdaDIST_PATH */

/** Dynamically set absolute public path from current protocol and host */
if (cdaDIST_PATH) {
  __webpack_public_path__ = cdaDIST_PATH; // eslint-disable-line no-undef, camelcase
}
