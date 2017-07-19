<?php
/**
 * This configuration will be read and overlaid on top of the
 * default configuration. Command line arguments will be applied
 * after this file is read.
 *
 * @see src/Phan/Config.php
 * See Config for all configurable options.
 */
return [
	// A list of directories that should be parsed for class and
	// method information. After excluding the directories
	// defined in exclude_analysis_directory_list, the remaining
	// files will be statically analyzed for errors.
	//
	// Thus, both first-party and third-party code being used by
	// your application should be included in this list.
	'directory_list' => [
		'build/.phan/stubs',
		'3rdparty',
		'lib/composer',
		'themes',
		'lib/',
		'apps/',
		'core/',
		'ocs/',
		'ocs-provider/',
		'settings/',
		'tests/lib/Util/User',
	],
	'file_list' => [
		'index.php',
		'version.php',
		'public.php',
		'remote.php',
		'status.php',
	],

	// A directory list that defines files that will be excluded
	// from static analysis, but whose class and method
	// information should be included.
	//
	// Generally, you'll want to include the directories for
	// third-party code (such as "vendor/") in this list.
	//
	// n.b.: If you'd like to parse but not analyze 3rd
	//       party code, directories containing that code
	//       should be added to the `directory_list` as
	//       to `exclude_analysis_directory_list`.
	'exclude_analysis_directory_list' => [
		'build/.phan/',
		'3rdparty',
		'lib/composer',
		'apps/admin_audit/tests',
		'apps/comments/tests',
		'apps/dav/tests',
		'apps/encryption/tests',
		'apps/federatedfilesharing/tests',
		'apps/federation/tests',
		'apps/files/tests',
		'apps/files_external/3rdparty',
		'apps/files_external/tests',
		'apps/files_sharing/tests',
		'apps/files_trashbin/tests',
		'apps/files_versions/tests',
		'apps/lookup_server_connector/tests',
		'apps/oauth2/tests',
		'apps/provisioning_api/tests',
		'apps/sharebymail/tests',
		'apps/systemtags/tests',
		'apps/testing/tests',
		'apps/theming/tests',
		'apps/twofactor_backupcodes/tests',
		'apps/updatenotification/tests',
		'apps/user_ldap/tests',
		'apps/workflowengine/tests',
		'settings/templates',
		'core/templates',
		'apps/user_ldap/templates/',
		'apps/updatenotification/templates/',
		'apps/twofactor_backupcodes/templates/',
		'apps/theming/templates/',
		'apps/sharebymail/templates/',
		'apps/files_trashbin/templates/',
		'apps/files_sharing/templates/',
		'apps/files_external/templates/',
		'apps/files/templates/',
		'apps/federatedfilesharing/templates/',
		'apps/encryption/templates/',
	],

	// A file list that defines files that will be excluded
	// from parsing and analysis and will not be read at all.
	//
	// This is useful for excluding hopelessly unanalyzable
	// files that can't be removed for whatever reason.
	'exclude_file_list' => [
		'settings/routes.php',
		'settings/ajax/updateapp.php',
		'settings/ajax/uninstallapp.php',
		'settings/ajax/togglesubadmins.php',
		'settings/ajax/setquota.php',
		'settings/ajax/navigationdetect.php',
		'settings/ajax/enableapp.php',
		'settings/ajax/disableapp.php',
		'core/register_command.php',
		'apps/testing/appinfo/routes.php',
		'ocs/routes.php',
		'ocs/v1.php',
		'core/routes.php',
	],


	// The number of processes to fork off during the analysis
	// phase.
	'processes' => 10,

	// Backwards Compatibility Checking. This is slow
	// and expensive, but you should consider running
	// it before upgrading your version of PHP to a
	// new version that has backward compatibility
	// breaks.
	'backward_compatibility_checks' => true,

	// Run a quick version of checks that takes less
	// time at the cost of not running as thorough
	// an analysis. You should consider setting this
	// to true only when you wish you had more issues
	// to fix in your code base.
	'quick_mode' => true,

	// If true, check to make sure the return type declared
	// in the doc-block (if any) matches the return type
	// declared in the method signature. This process is
	// slow.
	'check_docblock_signature_return_type_match' => true,

	// If true, check to make sure the return type declared
	// in the doc-block (if any) matches the return type
	// declared in the method signature. This process is
	// slow.
	'check_docblock_signature_param_type_match' => true,

	// (*Requires check_docblock_signature_param_type_match to be true*)
	// If true, make narrowed types from phpdoc params override
	// the real types from the signature, when real types exist.
	// (E.g. allows specifying desired lists of subclasses,
	//  or to indicate a preference for non-nullable types over nullable types)
	// Affects analysis of the body of the method and the param types passed in by callers.
	'prefer_narrowed_phpdoc_param_type' => true,

	// (*Requires check_docblock_signature_return_type_match to be true*)
	// If true, make narrowed types from phpdoc returns override
	// the real types from the signature, when real types exist.
	// (E.g. allows specifying desired lists of subclasses,
	//  or to indicate a preference for non-nullable types over nullable types)
	// Affects analysis of return statements in the body of the method and the return types passed in by callers.
	'prefer_narrowed_phpdoc_return_type' => true,

	// If enabled, check all methods that override a
	// parent method to make sure its signature is
	// compatible with the parent's. This check
	// can add quite a bit of time to the analysis.
	'analyze_signature_compatibility' => true,

	// The minimum severity level to report on. This can be
	// set to Issue::SEVERITY_LOW, Issue::SEVERITY_NORMAL or
	// Issue::SEVERITY_CRITICAL. Setting it to only
	// critical issues is a good place to start on a big
	// sloppy mature code base.
	'minimum_severity' => \Phan\Issue::SEVERITY_NORMAL,

	// If true, missing properties will be created when
	// they are first seen. If false, we'll report an
	// error message if there is an attempt to write
	// to a class property that wasn't explicitly
	// defined.
	'allow_missing_properties' => false,

	// Allow null to be cast as any type and for any
	// type to be cast to null. Setting this to false
	// will cut down on false positives.
	'null_casts_as_any_type' => false,

	// Allow null to be cast as any array-like type (Requires 0.9.3+)
	// This is an incremental step in migrating away from null_casts_as_any_type.
	// If null_casts_as_any_type is true, this has no effect.
	'null_casts_as_array' => false,

	// Allow any array-like type to be cast to null. (Requires 0.9.3+)
	// This is an incremental step in migrating away from null_casts_as_any_type.
	// If null_casts_as_any_type is true, this has no effect.
	'array_casts_as_null' => false,

	// If enabled, scalars (int, float, bool, true, false, string, null)
	// are treated as if they can cast to each other.
	'scalar_implicit_cast' => false,

	// If this has entries, scalars (int, float, bool, true, false, string, null)
	// are allowed to perform the casts listed.
	// E.g. ['int' => ['float', 'string'], 'float' => ['int'], 'string' => ['int'], 'null' => ['string']]
	// allows casting null to a string, but not vice versa.
	// (subset of scalar_implicit_cast)
	// (Requires 0.9.3+)
	'scalar_implicit_partial' => [],

	// If true, seemingly undeclared variables in the global
	// scope will be ignored. This is useful for projects
	// with complicated cross-file globals that you have no
	// hope of fixing.
	'ignore_undeclared_variables_in_global_scope' => false,

	// Add any issue types (such as 'PhanUndeclaredMethod')
	// to this black-list to inhibit them from being reported.
	'suppress_issue_types' => [
		// 'PhanUndeclaredMethod',
	],

	// If empty, no filter against issues types will be applied.
	// If this white-list is non-empty, only issues within the list
	// will be emitted by Phan.
	'whitelist_issue_types' => [
		// 'PhanAccessMethodPrivate',
	],

	// A list of plugin files to execute
	'plugins' => [
		'build/.phan/plugins/SqlInjectionCheckerPlugin.php',
	],
];
