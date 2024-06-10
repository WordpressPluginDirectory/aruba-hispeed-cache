<?php //@phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * ArubaHiSpeedCacheWpPurger
 * php version 5.6
 *
 * @category Wordpress-plugin
 * @package  Aruba-HiSpeed-Cache
 * @author   Aruba Developer <hispeedcache.developer@aruba.it>
 * @license  https://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @link     \ArubaHiSpeedCache\Run_Aruba_Hispeed_cache()
 * @since    1.1.3
 */

namespace ArubaSPA\HiSpeedCache\Debug;

//use ArubaSPA\HiSpeedCache\Traits\Instance;
//use ArubaSPA\HiSpeedCache\Admin\AdminClassTest;
//use ArubaSPA\HiSpeedCache\Container\ContainerBuilder;

if ( ! \class_exists( __NAMESPACE__ .DIRECTORY_SEPARATOR.'Logger' ) ) {

	/**
	 * Simple logger class.
	 *
	 * Log entries can be added with any of the following methods:
	 *  - Logger::info( $message, $title = '' )      // an informational message intended for the user
	 *  - Logger::debug( $message, $title = '' )     // a diagnostic message intended for the developer
	 *  - Logger::warning( $message, $title = '' )   // a warning that something might go wrong
	 *  - Logger::error( $message, $title = '' )     // explain why the program is going to crash
	 */
	class Logger {

		/**
		 * Incremental log, where each entry is an array with the following elements:
		 *
		 *  - timestamp => timestamp in seconds as returned by time()
		 *  - level => severity of the bug; one between debug, info, warning, error
		 *  - name => name of the log entry, optional
		 *  - message => actual log message
		 *
		 * @var array
		 */
		protected static $log = [];

		/**
		 * Whether to print log entries to screen as they are added.
		 *
		 * @var bool
		 */
		public static $print_log = false;

		/**
		 * Whether to write log entries to file as they are added.
		 *
		 * @var bool
		 */
		public static $write_log = true;

		/**
		 * Directory where the log will be dumped, without final slash; default
		 * is this file's directory
		 *
		 * @var string
		 */
		public static $log_dir = __DIR__;

		/**
		 * File name for the log saved in the log dir
		 *
		 * @var string
		 */
		public static $log_file_name = '';

		/**
		 * File extension for the logs saved in the log dir
		 *
		 * @var string
		 */
		public static $log_file_extension = 'log';

		/**
		 * Whether to append to the log file (true) or to overwrite it (false)
		 *
		 * @var bool
		 */
		public static $log_file_append = true;

		/**
		 * Set the maximum level of logging to write to logs
		 *
		 * @var string
		 */
		public static $log_level = 'debug';

		/**
		 * Name for the default timer
		 *
		 * @var string
		 */
		public static $default_timer = 'timer';

		/**
		 * Map logging levels to syslog specifications, there's room for the other levels
		 *
		 * @var array
		 */
		private static $log_level_integers = array(
			'debug'   => 7,
			'info'    => 6,
			'warning' => 4,
			'error'   => 3,
		);

		/**
		 * Absolute path of the log file, built at run time
		 *
		 * @var string
		 */
		private static $log_file_path = '';

		/**
		 * Where should we write/print the output to? Built at run time
		 *
		 * @var array
		 */
		private static $output_streams = array();

		/**
		 * Whether the init() function has already been called
		 *
		 * @var bool
		 */
		public static $logger_ready = false;

		/**
		 * Associative array used as a buffer to keep track of timed logs
		 *
		 * @var array
		 */
		private static $time_tracking = array();

		/**
		 * Add a log entry with a diagnostic message for the developer.
		 *
		 * @param  string $message The message.
		 * @param  string $name The name.
		 * @return self::add
		 */
		public static function debug( $message, $name = '' ) {
			return self::add( $message, $name, 'debug' );
		}

		/**
		 * Add a log entry with an informational message for the user.
		 *
		 * @param  string $message The message.
		 * @param  string $name The name.
		 * @return self::add
		 */
		public static function info( $message, $name = '' ) {
			return self::add( $message, $name, 'info' );
		}

		/**
		 * Add a log entry with a warning message.
		 *
		 * @param  string $message The message.
		 * @param  string $name The name.
		 * @return self::add
		 */
		public static function warning( $message, $name = '' ) {
			return self::add( $message, $name, 'warning' );
		}

		/**
		 * Add a log entry with an error - usually followed by
		 * script termination.
		 *
		 * @param  string $message The message.
		 * @param  string $name The name.
		 * @return self::add
		 */
		public static function error( $message, $name = '' ) {
			return self::add( $message, $name, 'error' );
		}

		/**
		 * Start counting time, using $name as identifier.
		 *
		 * Returns the start time or false if a time tracker with the same name
		 * exists
		 *
		 * @param  string|null $name The name.
		 * @return self::$time_tracking|bool
		 */
		public static function time( $name = null ) {
			if ( null === $name ) {
				$name = self::$default_timer;
			}

			if ( ! isset( self::$time_tracking[ $name ] ) ) {
				self::$time_tracking[ $name ] = microtime( true );
				return self::$time_tracking[ $name ];
			}

			return false;
		}

		/**
		 * Stop counting time, and create a log entry reporting the elapsed amount of
		 * time.
		 *
		 * Returns the total time elapsed for the given time-tracker, or false if the
		 * time tracker is not found.
		 *
		 * @param  string|null $name The name.
		 * @param  integer     $decimals The decimals.
		 * @param  string      $level The level.
		 * @return string|bool
		 */
		public static function time_end( $name = null, $decimals = 6, $level = 'debug' ) {
			$is_default_timer = ( null === $name ) ? true : false;

			if ( $is_default_timer ) {
				$name = self::$default_timer;
			}

			if ( isset( self::$time_tracking[ $name ] ) ) {
				$start        = self::$time_tracking[ $name ];
				$end          = microtime( true );
				$elapsed_time = number_format( ( $end - $start ), $decimals );
				unset( self::$time_tracking[ $name ] );

				if ( ! $is_default_timer ) {
					self::add( "$elapsed_time seconds", "Elapsed time for '$name'", $level );
					return $elapsed_time;
				}

				self::add( "$elapsed_time seconds", 'Elapsed time', $level );
				return $elapsed_time;
			}

			return false;
		}

		/**
		 * Add an entry to the log.
		 *
		 * This function does not update the pretty log.
		 *
		 * @param  string $message The message to log.
		 * @param  string $name The name of log.
		 * @param  string $level Level.
		 * @return void|array
		 */
		private static function add( $message, $name = '', $level = 'debug' ) {
			/* Check if the logging level severity warrants writing this log */
			if ( self::$log_level_integers[ $level ] > self::$log_level_integers[ self::$log_level ] ) {
				return;
			}

			/* Create the log entry */
			$log_entry = array(
				'timestamp' => time(),
				'name'      => $name,
				'message'   => $message,
				'level'     => $level,
			);

			/* Add the log entry to the incremental log */
			self::$log[] = $log_entry;

			/* Initialize the logger if it hasn't been done already */
			if ( ! self::$logger_ready ) {
				self::init();
			}

			/* Write the log to output, if requested */
			if ( self::$logger_ready && count( self::$output_streams ) > 0 ) {
				$output_line = self::format_log_entry( $log_entry ) . PHP_EOL;
				foreach ( self::$output_streams as $key => $stream ) {
					fputs( $stream, $output_line ); //phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fputs
				}
			}

			return $log_entry;
		}

		/**
		 * Take one log entry and return a one-line human readable string
		 *
		 * @param  array $log_entry The log entry.
		 * @return string
		 */
		public static function format_log_entry( $log_entry ) {
			$log_line = '';

			if ( ! empty( $log_entry ) ) {
				/* Make sure the log entry is stringified */
				$log_entry = array_map(
					function ( $entry ) {

						if ( \is_array( $entry ) ) {
							$entry = array_map(
								function ( $entry_array_value ) {
									if ( \is_bool( $entry_array_value ) ) {
										return ( $entry_array_value ) ? 'true' : 'false';
									}
									return $entry_array_value;
								},
								$entry
							);
						}

						return print_r( $entry, true ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_print_r
					},
					$log_entry
				);

				/* Build a line of the pretty log */
				$log_line .= \wp_date( 'c', $log_entry['timestamp'] ) . ' [' . strtoupper( $log_entry['level'] ) . '] : ';

				if ( ! empty( $log_entry['name'] ) ) {
					$log_line .= $log_entry['name'] . ' => ';
				}

				$log_line .= $log_entry['message'];
			}

			return $log_line;
		}

		/**
		 * Get ful path of log file.
		 *
		 * @return string
		 */
		public static function get_log_file_path_name() {
			return self::$log_dir . DIRECTORY_SEPARATOR . self::$log_file_name . '.' . self::$log_file_extension;
		}

		/**
		 * Get uri of log file.
		 *
		 * @param  string $host Base host file.
		 * @return string
		 */
		public static function get_log_file_url( $host ) {
			return $host . self::$log_file_name . '.' . self::$log_file_extension;
		}

		/**
		 * Determine whether an where the log needs to be written; executed only
		 * once.
		 *
		 * Return an associative array with the output streams. The
		 * keys are 'output' for STDOUT and the filename for file streams.
		 *
		 * @return void
		 */
		public static function init() {
			if ( ! self::$logger_ready ) {

				/* Print to screen */
				if ( true === self::$print_log ) {
					self::$output_streams['stdout'] = STDOUT;
				}

				/* Build log file path */
				if ( file_exists( self::$log_dir ) ) {
					self::$log_file_path = implode( DIRECTORY_SEPARATOR, [ self::$log_dir, self::$log_file_name ] );
					if ( ! empty( self::$log_file_extension ) ) {
						self::$log_file_path .= '.' . self::$log_file_extension;
					}
				}

				/* Print to log file */
				if ( true === self::$write_log ) {
					if ( file_exists( self::$log_dir ) ) {
						$mode = self::$log_file_append ? 'a' : 'w';
						self::$output_streams[ self::$log_file_path ] = fopen( self::$log_file_path, $mode ); //phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fopen
					}
				}
			}

			// Now that we have assigned the output stream, this function does not need to be called anymore.
			self::$logger_ready = true;
		}

		/**
		 * Dump the whole log to the given file.
		 *
		 * Useful if you don't know before-hand the name of the log file. Otherwise,
		 * you should use the real-time logging option, that is, the $write_log or
		 * $print_log options.
		 *
		 * The method format_log_entry() is used to format the log.
		 *
		 * @param {string} $file_path - Absolute path of the output file. If empty,
		 * will use the class property $log_file_path.
		 */
		public static function dump_to_file( $file_path = '' ) {
			if ( ! $file_path ) {
				$file_path = self::$log_file_path;
			}

			if ( file_exists( dirname( $file_path ) ) ) {
				$mode        = self::$log_file_append ? 'a' : 'w';
				$output_file = fopen( $file_path, $mode ); //phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fopen

				foreach ( self::$log as $log_entry ) {
					$log_line = self::format_log_entry( $log_entry );
					fwrite( $output_file, $log_line . PHP_EOL ); //phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fwrite
				}

				fclose( $output_file ); //phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fclose
			}
		}

		/**
		 * Dump the whole log to string, and return it.
		 *
		 * The method format_log_entry() is used to format the log.
		 *
		 * @return string
		 */
		public static function dump_to_string() {
			$output = '';

			foreach ( self::$log as $log_entry ) {
				$log_line = self::format_log_entry( $log_entry );
				$output  .= $log_line . PHP_EOL;
			}

			return $output;
		}

		/**
		 * Empty the log
		 *
		 * @return void
		 */
		public static function clear_log() {
			self::$log = [];
		}
	}
}
