<?php

declare(strict_types=1);

/**
 * Nextcloud - twofactor_yubikey
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Jack <site-nextcloud@jack.org.uk>
 * @copyright Jack 2016
 */

namespace OCA\TwoFactorYubikey\Provider;

use OCA\TwoFactorYubikey\Service\IYubiotp;
use OCP\Authentication\TwoFactorAuth\IProvider;
use OCP\IL10N;
use OCP\IUser;
use OCP\Template;

class YubikeyProvider implements IProvider {

	/** @var IYubiotp */
	private $yuibiotp;

	/** @var IL10N */
	private $l10n;

	/**
	 * @param Totp $totp
	 * @param IL10N $l10n
	 */
	public function __construct(IYubiotp $yuibiotp, IL10N $l10n) {
		$this->yuibiotp = $yuibiotp;
		$this->l10n = $l10n;
	}

	/**
	 * Get unique identifier of this 2FA provider
	 *
	 * @return string
	 */
	public function getId(): string {
		return 'yubiotp';
	}

	/**
	 * Get the display name for selecting the 2FA provider
	 *
	 * @return string
	 */
	public function getDisplayName(): string {
		return $this->l10n->t('Yubikey');
	}

	/**
	 * Get the display name for selecting the 2FA provider
	 *
	 * @return string
	 */
	public function getDescription(): string {
		return $this->l10n->t('Authenticate with a Yubikey device');
	}

	/**
	 * Get the template for rending the 2FA provider view
	 *
	 * @param IUser $user
	 *
	 * @return Template
	 */
	public function getTemplate(IUser $user): Template {
		return new Template('twofactor_yubikey', 'challenge-yubikey');
	}

	/**
	 * Verify the given challenge
	 *
	 * @param IUser $user
	 * @param string $challengeYubikey
	 */
	public function verifyChallenge(IUser $user, string $challengeYubikey): bool {
		return $this->yuibiotp->validateOTP($user, $challengeYubikey);
	}

	/**
	 * Decides whether 2FA is enabled for the given user
	 *
	 * @param IUser $user
	 *
	 * @return boolean
	 */
	public function isTwoFactorAuthEnabledForUser(IUser $user): bool {
		return $this->yuibiotp->hasKey($user);
	}
}
