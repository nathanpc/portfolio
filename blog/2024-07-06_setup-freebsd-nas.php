<?php
$post = array(
	'title' => 'Setting up a FreeBSD file server'
);
?>

<p>Recently I decided to dedicate one of my servers to being a dedicated NAS.
Previously I had 3 virtual machines running on a server with hard drives being
passed directly to them. Each one of these VMs ran FreeBSD and were dedicated to
a specific type of storage (personal, company, and media respectively). This
arrangement was OK, but I wanted to have my data to have a dedicated server,
simply because it always felt wrong to have such important data on the same
machine as regular services.</p>

<p>In order to move my data to a dedicated server I bought a used
<a href="https://support.hpe.com/connect/s/product?language=en_US&kmpmoid=1009955118&tab=driversAndSoftware">
HPE ProLiant MicroServer Gen10</a>, which is a very anemic machine, but I was
after its "NAS form factor", and for the very small amount of traffic this
server will see, its performance will be acceptable. It just has to house 4x 6TB
spinning rust hard drives and be able to saturate a 1GbE direct link to my
workstation. Most of what it needs to accomplish this is memory for the ZFS
cache.</p>

<p>After installing FreeBSD 14, the operating system that will most likely never
be upgraded to a new major version throughout the lifetime of the machine, some
preparations have to be done in order to ensure the longevity of the ZFS pool.
In my setup I have 3 identical (bought from the same lot) WD 6TB hard drives and
one 6TB Seagate drive, all with some age already. Since I want this server to
last, I anticipate I'll be replacing dead drives in the future when they fail,
and in order to give me some wiggle room in the future to buy any 6TB
replacement I want, <a href="https://serverfault.com/a/784494">it's important to
not give the entire drive to ZFS</a>, but instead to create a single partition
for ZFS with some small padding at the end. This ensures that if a newer hard
drive doesn't have the exact same number of bytes it can still be swapped into
the pool if needed.</p>

<p>The process I usually go through to prepare used hard drives is to destroy
any partition table first, recreate them, and only then properly partition. This
process has to be done for every hard drive you want to use in your pool. For
this example I'll be using <code>ada0</code>:</p>

<?php compat_code_begin('bash'); ?>gpart destroy -F ada0
gpart create -s GPT ada0
gpart add -t freebsd-zfs -a 1M -s 11721024088 ada0<?php compat_code_end(); ?>

<p>After the partitioning of every drive was done, the next step was to create
the ZFS pool. In my setup, since it will be holding extremely valuable data that
I cannot afford to loose I decided to go with a
<a href="https://raidz-calculator.com/raidz-types-reference.aspx">RAID-Z2</a>,
giving me 2 disks of fault tolerance (I have backups, but would like to never
have to restore them). In order to create the zpool I had to specify the
partitions that were created, not the entire disk:</p>

<?php compat_code_begin('bash'); ?>zpool create bulkstore raidz2 ada0p1 ada1p1 ada2p1 ada3p1<?php compat_code_end(); ?>

<p>Running a <code>zpool status</code> shows that the pool was created
successully and we can start creating datasets and migrating our data over.</p>

<?php compat_code_begin(); ?>  pool: bulkstore
 state: ONLINE
config:

	NAME        STATE     READ WRITE CKSUM
	bulkstore   ONLINE       0     0     0
	  raidz2-0  ONLINE       0     0     0
	    ada0p1  ONLINE       0     0     0
	    ada1p1  ONLINE       0     0     0
	    ada2p1  ONLINE       0     0     0
	    ada3p1  ONLINE       0     0     0

errors: No known data errors<?php compat_code_end(); ?>

<p>After having created the datasets and migrated the data from the backups of
the previous server, the next step is to actually share this data with other
computers on the network. The FreeBSD handbook has
<a href="https://docs.freebsd.org/en/books/handbook/network-servers/#network-nfs">
a great chapter on how to setup an NFS server</a>, all that you have to do is
add the following to your <code>/etc/rc.conf</code>:</p>

<?php compat_code_begin(); ?>rpcbind_enable="YES"
nfs_server_enable="YES"
mountd_enable="YES"
rpc_lockd_enable="YES"<?php compat_code_end(); ?>

<p>Now all that is left to do is edit the <code>/etc/exports</code> to configure
the shared folders and the access permissions. When that's done simply run
<code>service nfsd start</code> and your NFS server should be up and running.
</p>

<p>After the necessary services have been configured I've noticed that I still
ran into issues when trying to mount the shares on newer versions of macOS, so
instead of just running a <code>service nfsd start</code> I do advice you to
<b>restart the server</b>. This will ensure everything is brand new and ready to
go.</p>
